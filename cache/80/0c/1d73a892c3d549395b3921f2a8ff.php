<?php

/* shortener/result.html */
class __TwigTemplate_800c1d73a892c3d549395b3921f2a8ff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->loadTemplate("header.html")->display($context);
        // line 2
        echo "<div class=\"container col-offset-4\">
<div class=\"row\">
  <div class=\"col-lg-6\">
    <img src=\"http://estru.me/src/Estrume/View/assets/images/estruminho.png\" />
      <h4>HUEHUEHUEHUEHUE BR BR BR</h4>
    <div class=\"input-group\">
      <input type=\"text\" onclick=\"this.focus();this.select()\" class=\"form-control input-large\" id=\"result\" value=\"http://estru.me/";
        // line 8
        if (isset($context["shortened"])) { $_shortened_ = $context["shortened"]; } else { $_shortened_ = null; }
        echo twig_escape_filter($this->env, $_shortened_, "html", null, true);
        echo "\" readonly>
      
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>
";
        // line 14
        $this->env->loadTemplate("footer.html")->display($context);
    }

    public function getTemplateName()
    {
        return "shortener/result.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 14,  29 => 8,  21 => 2,  19 => 1,);
    }
}
