(function ($) {
	var dataKey = "xSwitcher";

	var DEFAULT_SETTINGS = {
		defaultValue: 0
	};

	var methods = {
		init: function (options) {
			var settings = $.extend({}, DEFAULT_SETTINGS, options || {});
			var index = 0;

			return this.each(function () {
				$(this).data(dataKey, new $.Switcher(this, settings, index));
				index++;
			});
		},
		reload: function () {
			//this.data(dataKey).reload();
			return this;
		}
	}

	$.fn.xSwitcher = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else {
			return methods.init.apply(this, arguments);
		}
	};

	$.Switcher = function (element, settings, index) {

		Init();

		function Init() {
			var elem = $(element);
			elem.addClass("btn-group btn-toggle");
			elem.attr("data-toggle", "buttons");

			var lblSim = $("<label>");
			lblSim.attr("class", "btn btn-sm");
			lblSim.click(optionClick);

			var lblNao = $("<label>");
			lblNao.attr("class", "btn btn-sm");
			lblNao.click(optionClick);

			var optSim = $("<input>");
			optSim.attr("type", "radio");
			optSim.attr("name", "switcher_" + index);
			optSim.val("1");
			lblSim.append(optSim);
			lblSim.append("Sim");

			var optNao = $("<input>");
			optNao.attr("type", "radio");
			optNao.attr("name", "switcher_" + index);
			optNao.val("0");
			lblNao.append(optNao);
			lblNao.append("Não");

			if (settings.defaultValue == 0) {
				lblSim.addClass("btn-default");
				lblNao.addClass("btn-primary");

				optNao.attr("checked", "checked");
				optNao.prop("checked", true);
			} else {
				lblNao.addClass("btn-default");
				lblSim.addClass("btn-primary");

				optSim.attr("checked", "checked");
				optSim.prop("checked", true);
			}

			elem.append(lblSim);
			elem.append(lblNao);
		}

		function optionClick(e) {
			var opt = $(e.currentTarget);
			var div = opt.parent();

			div.find(".btn-primary input").prop("checked", false);
			div.find(".btn-primary input").removeAttr("checked");
			div.find(".btn-primary").removeClass("btn-primary").addClass("btn-default");

			opt.addClass("btn-primary").removeClass("btn-default");
			$("input", this).prop("checked", true);
			$("input", this).attr("checked", "checked");
		}
	}
}(jQuery));

$(".simNao").xSwitcher({ defaultValue: 0});
