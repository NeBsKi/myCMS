$(document).ready(function(){

    tinymce.init({
        selector: 'textarea'
    });

    $( "#tabs" ).tabs();

    var dialogApprove = $("<div>დარწმუნებული ხარ?</div>").dialog({
        autoOpen: false,
        title: "წაშლა",
        modal: true,
        buttons: {
            "Yes": function () {
                if ($(".deleteForm input:checkbox:checked").length > 0){
                    $(this).dialog('close');
                    $('.deleteForm').submit();
                }else{
                    $(this).dialog('close');
                    $("<div>აირჩიეთ წასაშლელი გვერდი !</div>").dialog();
                }
            },
            "No": function () {
                $(this).dialog('close');
            }
        }
    });

    $(".btnDelete").click(function(e) {
        e.preventDefault();
        dialogApprove.dialog( "open" );
    });
    
    $(".btnUpdate").click(function(e){
        e.preventDefault();
        $("#updateForm").submit();
    })
    
    $(".btnEdit").click(function(e){
        e.preventDefault();
        if($(".deleteForm input:checkbox:checked").length > 1){
            $("<div>აირჩიეთ მარტო ერთი გვერდი !</div>").dialog();
        }else if($(".deleteForm input:checkbox:checked").length == 0){
            $("<div>აირჩიეთ გვერდი !</div>").dialog();
        }else{
            var checked_val = $(".deleteForm input:checkbox:checked").val();
            window.location.href = APP_URL+'/admin/page/'+checked_val+'/edit';
        }
    })
    
    $('.tree-pages ul.ui-sortable').sortable({
        cursor: "move"
    });
    
    
    $('h1.settings-heading').click(function(){
       $('.settings-panel').toggle(); 
    });
    
    $('h1.meta-heading').click(function(){
       $('.meta-panel').toggle(); 
    });
    
    Dropzone.options.addPagesGallery = {
        maxFileSize: 3,
        acceptedFiles: '.jpg, .jpeg, .png'
    };
    
    $('.filterReset').click(function(e){
        e.preventDefault();
        window.location.replace(APP_URL+'/admin/page');
    });
    
    $('.savePage').click(function(e){
        e.preventDefault();
        $('.savePageForm').submit(); 
    });
    
});

$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $(this).next("ul").hide();
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }

        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});


