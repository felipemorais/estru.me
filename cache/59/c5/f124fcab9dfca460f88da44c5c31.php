<?php

/* shortener/index.html */
class __TwigTemplate_59c5f124fcab9dfca460f88da44c5c31 extends Twig_Template
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
<form action=\"http://estru.me/shorten\" method=\"POST\" name=\"shorten\">
<div class=\"row\">
  <div class=\"col-lg-6\">
  <img src=\"http://estru.me/src/Estrume/View/assets/images/estruminho.png\" />
      <h4>ESTRUMINHO NÃO GOSTA DESSA URL GRANDE</h4>
    <div class=\"input-group\">
      <input type=\"text\" class=\"form-control input-large\" id=\"url\" name=\"url\">
      <span class=\"input-group-btn\">
        <input class=\"btn btn-default input-large\" type=\"submit\" id=\"sender\" value=\"Encurtar!\"/>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</form>
</div>
";
        // line 18
        $this->env->loadTemplate("footer.html")->display($context);
    }

    public function getTemplateName()
    {
        return "shortener/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 18,  21 => 2,  19 => 1,);
    }
}
