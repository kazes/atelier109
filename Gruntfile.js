/**
 * Created by stecov on 22/09/14.
 */

module.exports = function (grunt) {

    // Load tasks
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-combine-media-queries');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');


    var isbuild = grunt.cli.tasks[0] === 'build';

    var browsersList = [
        'IE > 8',
        'last 5 ff versions',
        'last 5 chrome versions',
        'last 3 Safari versions'
    ];
 
    // Ressources path
    var jsPath = './assets/js/';
    var cssDestinationPath = './';
    var scssPath = './assets/scss/';
    
    // options for POSTCSS
    var optionsDevPostCSS = {
        options: {
            map: true,
            processors: [
                require('autoprefixer')({browsers: browsersList})
            ]
        },
        dist: {
            src: cssDestinationPath + 'style.css'
        }
    };
    
    
    var optionsProdPostCSS = {
        options: {
            map: false,
            processors: [
                require('autoprefixer')({browsers: browsersList}),
                require('cssnano')
            ]
        },
        prod: {
            src: cssDestinationPath + 'style.min.css'
        }
    };

    // Config
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Uglify javascript files
        uglify: {
            prod: {
                files: {
                    'compiled-scripts/vendors.min.js': ['assets/js/vendors/*.js'],
                    'compiled-scripts/bundle.min.js': ['compiled-scripts/bundle.js']
                }
            }
        },

        // Compile sass files
        sass: {
            prod: {
                options: {
                    outputStyle: 'compressed',
                    indentType: 'space',
                    indentWidth: 0,
                    debugInfo: false,
                    lineNumbers: false,
                    sourceMap: false,
                    outFile: null
                },
                expand: true,
                cwd: scssPath,
                src: ['style.scss'],
                dest: cssDestinationPath,
                ext: '.min.css'
            },
            dev: {
                options: {
                    outputStyle: 'expanded',
                    indentType: 'space',
                    indentWidth: 4,
                    debugInfo: false,
                    lineNumbers: true,
                    sourceMap: true,
                    outFile: null
                },
                expand: true,
                cwd: scssPath,
                src: ['style.scss'],
                dest: cssDestinationPath,
                ext: '.css'
            }
        },

        // Combine media queries
        cmq: {
            options: {
                log: true
            },
            prod: {
                files: {
                    'styles': [cssDestinationPath + '*.css']
                }
            }
        },

        // Add vendor prefixed styles
        postcss: isbuild ? optionsProdPostCSS : optionsDevPostCSS,
        // watch changes
        watch: {
            options: {
                debounceDelay: 100,
                livereload: true // http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-
            },
            configFiles: {
                files: ['Gruntfile.js']
            },
            markup: {
                files: ['**/*.php'],
                options: {
                    spawn: false
                }
            },
            scripts: {
                files: [jsPath + '**/*.js'],
                tasks: ['exec'],
                options: {
                    spawn: false
                }
            },
            css: {
                files: [scssPath + '**/*.scss'],
                tasks: ['s'],

                options: {
                    spawn: false
                }
            }
        }


    });

    // Register tasks
    grunt.registerTask('s', ['sass:dev', 'cmq', 'postcss']);
    grunt.registerTask('fw', ['s', 'watch:css']);
    grunt.registerTask('build', ['sass:prod', 'cmq', 'postcss', 'uglify']);
    grunt.registerTask('default', ['watch']);
};