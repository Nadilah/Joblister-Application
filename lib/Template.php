<?php class Template{
    // Path to template = we could extend this class but 
    // still use this property
    protected $template;
    // Vars Passed In with actually gonna be an array.
    protected $vars = array();

    // constructer
    public function __construct($template){
        $this->template = $template; // actually set to the actual property
    }

    // actually get the method of template variable
    public function __get($key){
        return $this->vars[$key];

    }
    
    public function __set($key,$value){
        $this->vars[$key] = $value;
    }

    // we basically want use it as a string
    public function __tostring(){
        // instead of use $template-> name. we use $name. so thats the function of extract
        extract($this->vars);
        chdir(dirname($this->template));
        // we want to be able to output the template 
        // so we gonna start a buffer using obstart function 
        ob_start(); 

        //we need to the template path, so use include basename
        include basename($this->template);

        return ob_get_clean();
        
        //template class that we can use in different project

    }
}