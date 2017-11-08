import path from 'path';
import webpack from 'webpack';

const baseRoot = './html/simulation',
    baseAssets = './html/simulation/assets',
    srcRoot = './src/simulation',
    srcAssets = '/src/simulation/assets';

const DEBUG = !process.argv.includes('--release');
const VERBOSE = process.argv.includes('--verbose');

const GLOBALS = {
    'process.env.NODE_ENV': DEBUG ? '"development"' : '"production"',
    __DEV__: DEBUG,
};

module.exports = {
    context: path.resolve(__dirname, srcRoot),
    watch: true,
    cache: true,
    entry: {
        scripts: 'assets/js/scripts',
        'scripts-printc': 'assets/js/scripts-printc',
    },
    output: {
        publicPath: srcAssets,
        path: path.resolve(__dirname, baseRoot),
        filename: '[name].min.js'
    },
    resolve: { 
        root: path.resolve(__dirname, srcRoot),
        modulesDirectories: ['node_modules'],
        extensions: ['', '.webpack.js', '.web.js', '.js', '.jsx', '.json'],
        alias: { 
            'jquery': `${__dirname}/node_modules/jquery/dist/jquery`,
        } 
    },
    plugins: [
        new webpack.ProvidePlugin({
            jQuery: 'jquery',
            $: 'jquery',
            jquery: 'jquery',
            riot: 'riot/riot',
        }),
    ],
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                loader: 'babel-loader',
                include: [
                  path.resolve(__dirname, srcRoot),
                ],
            },
            { 
                test: /\.json$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'json-loader',
            },
        ]
    },
    //devtool: "source-map"
};
