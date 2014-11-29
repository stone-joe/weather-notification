module.exports = function(grunt){
    grunt.initConfig({
	pkg: grunt.file.readJSON("package.json"),
	concat: {
	    js: {
		files: {
		    "dist/main.js": ["app/scripts/weather.js","app/scripts/**/*.js"]
		}
	    },
	    scss: {
		files: {
		    "app/sass_dist/weather.scss": ["app/sass/**/*.scss"],
		}
	    }
	},
	uglify: {
	    options: {
		banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
	    },
	    dist : {
		files: {
		    'dist/<%= pkg.name %>.min.js': [""]
		}
	    }
	},
	jshint : {
	    files: ["Gruntfile.js","app/scripts/**/*.js"]
	},
	jade : {
	    compile: {
		options: {
		    client: false,
		    pretty: true
		},
		files: [{
		    cwd: "app",
		    src: "**/*.jade",
		    dest: "dist",
		    expand: true,
		    ext: ".html"
		}]
	    }
	},
	compass: {
	    dist: {
		options: {
		    sassDir: "app/sass_dist",
		    cssDir: "dist"
		}
	    }
	},
	serve : {
	    options: {
		port: 9000
	    },
	    path: "dist"
	},
	watch: {
	    options: {
		interrupt: true
	    },
	    scripts: {
		files: ["app/scripts/**/*.js"],
		tasks: ["jshint","concat:js"]
	    },
	    css: {
		files: ["app/sass/**/*.scss"],
		tasks: ["concat:scss","compass"]
	    },
	    jade: {
		files: ["app/index.jade","app/views/**/*.jade"],
		tasks: ["jade"]
	    }
	}
    });
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-jade");
    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-serve");
    grunt.loadNpmTasks("grunt-contrib-watch");

    grunt.registerTask("default",["jade","jshint","concat","compass","serve"]);
};
