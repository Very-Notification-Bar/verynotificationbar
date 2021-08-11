<?php

require_once ("field_model.php");

//add menu under settings tab
add_action('admin_menu', 'notification_bar_menu');
function notification_bar_menu()
{
    add_menu_page(__("Configurer la barre de notification", "notification_bar"), 
                    "Very Notification Bar", 
                    "manage_options", 
                    "notification_bar_settings",
                    "notification_bar_setting_page"
                );
}

/**
 * add setting page
 * save setting page
 */
function notification_bar_setting_page()
{
    //add update message
    if( isset( $_GET['settings-updated'])) 
    {
        add_settings_error('notification_bar_settings', 'updated_message', __('Modifications enregistrées', 'notification_bar'), 'updated');
    }
    settings_errors('notification_bar_settings');
?>
    <div class="wrap">
        <h1> <?php echo _e("Configurer la barre de notification", "notification_bar") ?> </h1>
        <form method="POST" action="options.php">
            <?php
                //return the code to tell the form what to do
                settings_fields("notification_settings");  
                
                //Display the sections assigned to the page and the parameters it contains
                do_settings_sections("notification_settings");
                
                submit_button();  
            ?>
        </form>
    </div>
<?php
}

//stylize the setting page
add_action('admin_enqueue_scripts', 'setting_page_style'); 
function setting_page_style() {
    wp_enqueue_style('setting_page', plugin_dir_url( __FILE__ ) . '../css/setting_page.css');
}

//load jquery
add_action('wp_enqueue_scripts', 'load_script');
function load_script() {
    wp_enqueue_script('jquery');
}

add_action('admin_init', 'general_setting');
function general_setting()
{
    add_settings_section("notification_bar_general_setting",
                            __("Configuration générale : ", "notification_bar"),
                            "",
                            "notification_settings"
                        );

    add_settings_field("deactivation_activation",
                        __("Désactiver / Activer", "notification_bar"),
                        "display_bar",
                        "notification_settings",
                        "notification_bar_general_setting"
                        );
    register_setting("notification_settings",
                    "deactivation_activation"
                    );
}

//init setting text section, init setting field and register setting page
add_action('admin_init', 'notification_bar_settings');
function notification_bar_settings()
{
    //save a group section for option related settings, add new sections
    add_settings_section("notification_bar_section",
                            __("Configurations de la barre : ", "notification_bar"), 
                            "", 
                            "notification_settings" 
                        );
           
    $tab_fields = array(
            array(
                "id" => "notification_background_color",
                "name" => __("Couleur de la barre", "notification_bar"),
                "function_name" => "bg_color",
                "setting" => "notification_settings",
                "section" => "notification_bar_section"
            ),
            array(
                "id" => "notification_bar_text",
                "name" => __("Texte à afficher", "notification_bar"),
                "function_name" => "txt_value",
                "setting" => "notification_settings",
                "section" => "notification_bar_section"
            ), 
            array(
                "id" => "notification_text_color",
                "name" => __("Couleur du texte", "notification_bar"),
                "function_name" => "text_color",
                "setting" => "notification_settings",
                "section" => "notification_bar_section"
            ), 
            array(
                "id" => "text_font",
                "name" =>__("Police", "notification_bar"), 
                "function_name" => "text_font",
                "setting" => "notification_settings",
                "section" => "notification_bar_section"
            ),
            array(
                "id" => "text_size",
                "name" => __("Taille du texte (px)", "notification_bar"), 
                "function_name" => "text_size",
                "setting" => "notification_settings",
                "section" => "notification_bar_section"
            )
    );
    //settings fields
    foreach($tab_fields as $field){
        add_settings_field(
            $field['id'],
            $field['name'],
            $field['function_name'],
            $field['setting'],
            $field['section']
        );
        register_setting(
            $field['setting'],
            $field['id']
        );
    }
}
// init setting button section, init setting field and register setting page
add_action('admin_init', 'notification_bar_button');
function notification_bar_button()
{
    add_settings_section("notification_bar_section_button",
                            __("Configurations du bouton : ", "notification_bar"), 
                            "", 
                            "notification_settings" 
                        );
           
    $tab_button_fields = array(
        array(
            "id" => "button_bg_color",
            "name" => __("Couleur", "notification_bar"), 
            "function_name" => "button_color",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "button_color_hover",
            "name" => __("Couleur au survol", "notification_bar"), 
            "function_name" => "button_hover",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "text_button",
            "name" => __("Texte à afficher", "notification_bar"), 
            "function_name" => "button_txt",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "size_button",
            "name" => __("Taille de la police (px)", "notification_bar"), 
            "function_name" => "button_size",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "padding_button",
            "name" => __("Taille de la marge dans le bouton (px)", "notification_bar"), 
            "function_name" => "padding_btn",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "button_text_color",
            "name" => __("Couleur du texte", "notification_bar"), 
            "function_name" => "button_text_color",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "txt_color_hover",
            "name" => __("Couleur du texte au survol", "notification_bar"),
            "function_name" => "button_txt_hover",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "button_font",
            "name" => __("Police", "notification_bar"), 
            "function_name" => "button_font",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "button_action",
            "name" => __("Lien", "notification_bar"),
            "function_name" => "action_button",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        ),
        array(
            "id" => "link_open_option",
            "name" => __("Ouvrir le lien dans un nouvel onglet ?", "notification_bar"),
            "function_name" => "link_option",
            "setting" => "notification_settings",
            "section" => "notification_bar_section_button"
        )
    );
    foreach($tab_button_fields as $field){
        add_settings_field(
            $field['id'],
            $field['name'],
            $field['function_name'],
            $field['setting'],
            $field['section']
        );
        register_setting(
            $field['setting'],
            $field['id']
        );
    }
}

//add fields to setting page
function display_bar()
{
    ?>
        <label class="switch">
            <input type="checkbox" name="deactivation_activation" value="1" <?php checked(1, get_option('deactivation_activation'), true); ?> />
            <div class="slider round"></div>
        </label>
    <?php
}

function txt_value()
{
    $val_text = get_option('notification_bar_text');
    //call the function text_model in field_model.php
    echo text_model("text", "text_field_setting_page_class", "notification_bar_text", $val_text);
}

function button_txt()
{
    $val_text_btn = get_option('text_button');
    echo text_model("text", "", "text_button", $val_text_btn);
}

function button_text_color()
{
    $val_btn_txt_color = get_option('button_text_color');
    echo text_model("color", "", "button_text_color", $val_btn_txt_color);
}

function bg_color()
{
    $val_notif_bg_color = get_option('notification_background_color');
    echo text_model("color", "", "notification_background_color", $val_notif_bg_color);
}

function text_color()
{
    $val_notif_txt_color = get_option('notification_text_color');
    echo text_model("color", "", "notification_text_color", $val_notif_txt_color);
}

function text_font()
{
    $val_txt_font = get_option('text_font');
    ?>
        <div>
            <select name="text_font">
                <?php
                    select_model($val_txt_font);
                ?>
            </select>
        </div>
    <?php
}

function text_size(){
    $val_txt_size = get_option('text_size');
    echo number_model("number", "text_size", $val_txt_size);
}

function button_font()
{
    $val_btn_font = get_option('button_font');
    ?>
       <div>
            <select name="button_font">
                <?php
                    select_model($val_btn_font);
                ?>
            </select>
        </div>
    <?php
}

function button_size()
{
    $val_btn_size = get_option('size_button');
    //call the function number_model in field_model.php
    echo number_model("number", "size_button", $val_btn_size);
}

function button_color()
{
    $val_btn_bg_color = get_option('button_bg_color');
    echo text_model("color", "", "button_bg_color", $val_btn_bg_color);
}

function button_hover()
{
    $val_btn_color_hover = get_option('button_color_hover');
    echo text_model("color", "", "button_color_hover", $val_btn_color_hover);
}

function action_button()
{
    $val_btn_action = get_option('button_action');
    echo text_model("text", "", "button_action", $val_btn_action);
}

function button_txt_hover()
{
    $val_txt_hover = get_option('txt_color_hover');
    echo text_model("color", "", "txt_color_hover", $val_txt_hover);
}

function link_option()
{
    ?>
        <div>
            <input type="checkbox" name="link_open_option" value="1" <?php checked(1, get_option('link_open_option'), true); ?> />
        </div>
    <?php
}

function padding_btn()
{
    $val_padding_btn = get_option('padding_button');
    echo number_model("number", "padding_button", $val_padding_btn);
}

//stylize the notification bar
add_action('wp_head', 'stylization_notification_bar');
function stylization_notification_bar()
{
    $val_btn_txt_color = get_option('button_text_color');
    $val_btn_color_hover = get_option('button_color_hover');
    $val_notif_bg_color = get_option('notification_background_color');
    $val_notif_txt_color = get_option('notification_text_color');
    $val_txt_font = get_option('text_font');
    $val_btn_bg_color = get_option('button_bg_color');
    $val_btn_font = get_option('button_font');
    $val_btn_size = get_option('size_button');
    $val_txt_size = get_option('text_size');
    $val_txt_hover = get_option('txt_color_hover');
    $val_padding_btn = get_option('padding_button');

    $val_checked = get_option('deactivation_activation');
    $activate = ($val_checked == 1) ? "" : "none";
        ?>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=<?php echo $val_txt_font ?>&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=<?php echo $val_btn_font ?>&display=swap');
                
                #button_notif_bar_id{
                    color: <?php echo $val_btn_txt_color ?>;
                    background-color: <?php echo $val_btn_bg_color ?>;
                    border-radius: 7px; 
                    font-family: "<?php echo $val_btn_font ?>"; 
                    font-size: <?php echo $val_btn_size ?>px;
                    text-transform: none ;
                    margin: 0.4em; 
                    padding: <?php echo $val_padding_btn ?>px; 
                    border-style: none;
                    text-decoration: none !important;
                }
                #button_notif_bar_id:hover{
                    background-color: <?php echo $val_btn_color_hover ?> !important;
                    text-decoration: none;
                    border-color: <?php echo $val_btn_color_hover ?> ;
                    border-style: none;
                    color: <?php echo $val_txt_hover ?>;
                    text-transform: none !important;
                }
                #div_notif_bar_id{
                    z-index: 99999999; 
                    color: <?php echo $val_notif_txt_color ?>;
                    background-color: <?php echo $val_notif_bg_color ?>; 
                    position:fixed; 
                    top:0; 
                    width:100%; 
                    text-align:center !important;
                    display: <?php echo $activate ?>;
                }
                #txt_notif_bar{
                    font-family: "<?php echo $val_txt_font ?>"; 
                    font-size: <?php echo $val_txt_size ?>px;
                    margin: auto;
                }
               
                @media(max-width: 767px)
                {
                    #button_notif_bar_id{
                        font-size: 0.625em !important;
                    }
                    #txt_notif_bar{
                        font-size: 0.938em !important;
                    }
                }
            </style>
            <script>
                (function( $ ) {
                    const marginAndPaddingBar = () => {
                        let barHeight;
                        let display_bar =  $('#div_notif_bar_id').css('display');
    
                        if ( ($('.div_notif_bar_class').length > 0) && (display_bar != "none") ) {
                            barHeight = $('.div_notif_bar_class').outerHeight();
                            $('body').css('padding-top', barHeight);
                        }
                        if ( ($('#wpadminbar').length > 0) && (display_bar != "none") ) {
                            barHeight = $('#wpadminbar').outerHeight();
                            $('.div_notif_bar_class').css('margin-top', barHeight);
                        }
                    };

                    $(window).resize(function(){
                        marginAndPaddingBar();
                    });
                    $(window).on("load", function(){
                        marginAndPaddingBar();
                    });
                })( jQuery );    
            </script>
        <?php
}

//create the notification bar
add_action('wp_footer', 'notification_bar_head');
function notification_bar_head()
{
    $val_text = get_option('notification_bar_text');
    $val_text_btn = get_option('text_button');
    $val_btn_action = get_option('button_action');
    $val_link_option = get_option('link_open_option');

    $val_target = ($val_link_option == 1) ? "_blank" : "_self";
        
    echo   "<div id='div_notif_bar_id' class='div_notif_bar_class'>
                    <p id='txt_notif_bar'>" .$val_text."
                        <a href='".$val_btn_action."' target='".$val_target."' > 
                            <input type='submit' 
                                    id='button_notif_bar_id' 
                                    value='".ucfirst(stripslashes(htmlspecialchars($val_text_btn, ENT_QUOTES)))."' 
                            /> 
                        </a>
                    </p>
            </div>";
}