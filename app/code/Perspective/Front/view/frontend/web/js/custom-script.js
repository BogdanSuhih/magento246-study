define([
    'jquery'
], function ($) {
    'use strict';

    return function (config, element) {
        // Получение значения из конфигурации
        var myConfigValue = config.myConfigValue;
        // Получение элемента
        var myElement = $(element);

        // Ваша логика на основе config и element

        console.log('Config value:', myConfigValue);
        console.log('Element:', myElement);
    };
});
