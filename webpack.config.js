const Encore = require('@symfony/webpack-encore');

Encore
    .enableSingleRuntimeChunk()
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    .addStyleEntry('style/cake.min', './assets/sass/cake.scss')
;


module.exports = Encore.getWebpackConfig();