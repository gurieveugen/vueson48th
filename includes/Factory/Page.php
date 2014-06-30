<?php
namespace Factory;

class Page extends Factory{
    //                                       __  _          
    //     ____  _________  ____  ___  _____/ /_(_)__  _____
    //    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
    //   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
    //  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
    // /_/              /_/                                 
    private $title;
    private $options;
    private $controls;
    //                    __  __              __    
    //    ____ ___  ___  / /_/ /_  ____  ____/ /____
    //   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
    //  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
    // /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
    public function __construct($title, $options = array())
    {
        $this->title = $title;
        $defaults = array(
            'icon_code'   => '',
            'menu_slug'   => $this->formatName($title),
            'parent_page' => 'themes.php',
            'capability'  => 'administrator',
            'page_title'  => ucwords($title),
            'menu_title'  => ucwords($title));
        $this->options   = array_merge($defaults, $options);
        $this->post_type = $this->options['menu_slug'];
        // =========================================================
        // HOOKS
        // =========================================================        
        add_action('admin_enqueue_scripts', array(&$this, 'adminScriptsAndStyles'));
        
    }

    /**
     * Initialize page
     */
    public function initPage()
    {
        add_action('admin_menu', array($this, 'addPage')); 
        $this->adminInit(array(&$this, 'registerSettings'));
       
    }

    public function registerSettings()
    {
        foreach ($this->controls as $section) 
        {
            $ctrls = $section['controls']->getControls();
            foreach ($ctrls as $ctrl) 
            {                
                register_setting($this->formatControlName($section['name']), $this->formatControlName($ctrl->name), array(&$this, 'sanitize'));
            }
        }
    }

    /**
     * TODO
     * @param  mixed $input 
     * @return mixed
     */
    public function sanitize($input)
    {
        return $input;
    }

    /**
     * Add page to menu
     */
    public function addPage()
    {
        if($this->options['parent_page'] != '')
        {
            add_submenu_page(
                $this->options['parent_page'], 
                $this->options['page_title'], 
                $this->options['menu_title'], 
                $this->options['capability'], 
                $this->options['menu_slug'], 
                array(&$this, 'renderPage'));     
        }
        else
        {
            add_menu_page(
                $this->options['page_title'], 
                $this->options['menu_title'], 
                $this->options['capability'], 
                $this->options['menu_slug'], 
                array(&$this, 'renderPage'));
        }
        if($this->options['icon_code'] != '') add_action('admin_enqueue_scripts', array(&$this, 'addMenuIcon'));
    }   

    /**
     * Add section and controls to page
     * @param string $section_title --- section title
     * @param array  $controls      --- controls collection or controls array
     * @param array  $args          --- section options
     */
    public function addControls($section_title, $controls = array(), $args = array())
    {
        $defaults = array(
            'title'    => $section_title,
            'name'     => $this->formatName($section_title),
            'controls' => $controls);
        $args = array_merge($defaults, $args);
        $this->controls[$args['name']] = $args;
    }

    /**
     * Get all options from this page
     * @return array --- page saved options
     */
    public function getAll()
    {
        return get_option($this->options['menu_slug']);
    }


    /**
     * Render page
     */
    public function renderPage()
    {        
        ?>
        <h2><?php echo $this->options['page_title']; ?></h2>
        <div class="wrap">                         
            <form method="post" action="options.php">
            <?php                        
                foreach ($this->controls as $section) 
                {
                    settings_fields($this->formatControlName($section['name']));       
                    printf('<h2>%s</h2>', $section['title']);
                    $ctrls = $section['controls']->getControls();
                    if($ctrls)
                    {           
                        echo '<table class="form-table"><tbody>';
                        foreach ($ctrls as $ctrl) 
                        {
                            $tmp       = clone $ctrl;
                            $tmp->name = $this->formatControlName($tmp->name);              
                            $value     = get_option($tmp->name);           
                            ?>
                            <tr class="form-field">
                                <th scope="row"><label for="<?php echo $tmp->name; ?>"><?php _e($tmp->title); ?></label></th>
                                <td><?php echo $tmp->getHtml($value); ?><br>
                                <span class="description"><?php echo $tmp->description; ?></span></td>
                            </tr>           
                            <?php                           
                        }
                        echo '</tbody></table>';
                    }
                }
                echo '<input type="hidden" name="action" value="update" />';
                submit_button();             
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Add scripts and styles to admin panel
     */
    public function adminScriptsAndStyles()
    {
        wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');        
    }

    /**
     * Add Font Awesome icon to menu
     */
    public function addMenuIcon()
    {       
        ?>
        <style>
            #adminmenu #toplevel_page_<?php echo $this->options['menu_slug']; ?> .wp-menu-image:before {
                content: "\<?php echo $this->options['icon_code']; ?>";  
                font-family: 'FontAwesome' !important;
                font-size: 18px !important;
            }
        </style>
        <?php
    }
}

