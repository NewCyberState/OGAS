/* ------------------------------------------------------------------------------
 *
 *  # Learning page kit
 *
 *  Demo JS code for learning html page kit - detailed view
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var LearningCourseDetailed = function() {


    //
    // Setup module components
    //

    // CKEditor
    var _componentCKEditor = function() {
        if (typeof CKEDITOR == 'undefined') {
            console.warn('Warning - ckeditor.js is not loaded.');
            return;
        }

        // Initialize
        CKEDITOR.replace('add-comment', {
            height: 200,
            removeButtons: 'Subscript,Superscript',
            toolbarGroups: [
                { name: 'styles' },
                { name: 'editing',     groups: [ 'find', 'selection' ] },
                { name: 'basicstyles', groups: [ 'basicstyles' ] },
                { name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'colors' },
                { name: 'tools' },
                { name: 'others' },
                { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] }
            ]
        });    
    };

    // Schedule
    var _componentFullCalendar = function() {
        if (typeof FullCalendar == 'undefined') {
            console.warn('Warning - Fullcalendar files are not loaded.');
            return;
        }

        // Add events
        var eventColors = [
            {
                title: 'Data management',
                start: '2014-11-02',
                color: '#EF5350'
            },
            {
                title: 'Web development',
                start: '2014-11-02',
                end: '2014-11-04',
                color: '#26A69A'
            },
            {
                title: 'UX design camp',
                start: '2014-11-05',
                end: '2014-11-07',
                color: '#5C6BC0'
            },
            {
                id: 999,
                title: 'Business development',
                start: '2014-11-09',
                color: '#26A69A'
            },
            {
                id: 999,
                title: 'Business development',
                start: '2014-11-16',
                end: '2014-11-18',
                color: '#26A69A'
            },
            {
                title: 'Marketing strategy',
                start: '2014-11-19',
                end: '2014-11-22',
                color: '#66BB6A'
            },
            {
                title: 'Web development',
                start: '2014-11-12T10:30:00',
                end: '2014-11-12T12:30:00',
                color: '#EC407A'
            },
            {
                title: 'LESS language',
                start: '2014-11-12T12:00:00',
                color: '#EC407A'
            },
            {
                title: 'SASS language',
                start: '2014-11-12T14:30:00',
                color: '#EC407A'
            },
            {
                title: 'PHP language',
                start: '2014-11-12T17:30:00',
                color: '#EC407A'
            },
            {
                title: 'Python language',
                start: '2014-11-12T20:00:00',
                color: '#EC407A'
            },
            {
                title: 'Operations',
                start: '2014-11-24',
                end: '2014-11-26',
                color: '#795548'
            },
            {
                title: 'Finances',
                start: '2014-11-27',
                end: '2014-11-29',
                color: '#FF7043'
            }
        ];

        // Define element
        var scheduleElement = document.querySelector('.schedule');

        // Initialize
        if(scheduleElement) {
            var scheduleInit = new FullCalendar.Calendar(scheduleElement, {
                plugins: [ 'dayGrid', 'timeGrid', 'interaction' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                defaultDate: '2014-11-12',
                businessHours: true,
                events: eventColors
            });

            // Render if inside hidden element
            $('a[href="#course-schedule"]').on('shown.bs.tab', function (e) {
                scheduleInit.render();
            });
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentCKEditor();
            _componentFullCalendar();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    LearningCourseDetailed.init();
});
