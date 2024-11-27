module.exports = function(grunt) {
    // Cargar todas las tareas de Grunt automáticamente
    require('load-grunt-tasks')(grunt);
  
    // Configuración de tareas
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      // Aquí irán las configuraciones de tus tareas
    });
  
    // Cargar las tareas
    grunt.registerTask('default', ['task1', 'task2']);
  };
  