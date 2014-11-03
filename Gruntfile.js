//Gruntfile
module.exports = function (grunt) {

    //Initializing the configuration object
    grunt.initConfig({

        // Task configuration
        concat: {
            options: {
                separator: ';'
            },
            js_backend: {
                src: [
                    './public/vendor/jquery/dist/jquery.js',
                    './public/vendor/bootstrap/dist/js/bootstrap.js',
                    './app/assets/javascript/backend.js'
                ],
                dest: './public/assets/javascript/backend.js'
            }
        },
        less: {
            development: {
                options: {
                    compress: false  //minifying the result
                },
                files: {
                    //compiling backend.less into backend.css
                    "./public/assets/stylesheets/backend.css": "./app/assets/stylesheets/backend.less"
                }
            }
        },
        phpunit: {
            classes: {
                dir: 'app/tests/'   //location of the tests
            },
            options: {
                bin: 'vendor/bin/phpunit',
                colors: true
            }
        },
        uglify: {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            backend: {
                files: {
                    './public/assets/javascript/backend.js': './public/assets/javascript/backend.js',
                }
            }
        },
        watch: {
            js_backend: {
                files: [
                    //watched files
                    './bower_components/jquery/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './app/assets/javascript/backend.js'
                ],
                tasks: ['concat:js_backend', 'uglify:backend'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            less: {
                files: ['./app/assets/stylesheets/*.less'],  //watched files
                tasks: ['less'],                          //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            tests: {
                files: ['app/controllers/*.php', 'app/models/*.php'],  //the task will run only when you save files in this location
                tasks: ['phpunit']
            }
        }
    });

    // // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-phpunit');


    // Task definition
    grunt.registerTask('default', ['watch']);

};