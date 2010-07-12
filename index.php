<?php
require_once 'Application/Lib/Application.php';
$boot = new Lib_Application();
echo ini_get('error_reporting');
/**
 * Elke page heeft een naam en een parrent (main menu item)
 * parrent>menu item. maar sub,sub items moeten dan uniek zijn.
 * Eerste element kan een module zijn *plugin* als dat het geval is, 
 * word de rest van de url afhandeling daar uitgevoerd. 
 * Waardes worden meegestuurd in een array.
 * Elke plugin heeft de mogelijkheid,
 * om simpelweg een andere url formatting te gebruiken.
 * Deze kunnen dus optioneel aangepast worden in de xwcms admin, 
 * onder plugins>plugin_naam>url formatting.
 * 
 * Side note: het gebruik van plugins kan worden bepaald bij creatie,
 * Bijvoorbeeld 1 forum per xwcms systeem. 
 * Deze kan echter wel op meerdere pagina's voorkomen, 
 * maar dit is en blijft de zelfde plugin, met de zelfde database.
 *
 *
 * url formats:
 * - [Module/plugin example page]
 * ==============================
 *
 * Default (no rewrite enabled)
 * http://www.sxwcms.be/?p=blog_topic_topic-title-here_123.html
 * http://www.sxwcms.be/?p=my-work_portfolio_view_portfolioItem_123.html
 *
 *
 * mimic static file
 * http://www.sxwcms.be/blog_topic_topic-title-here_123.html
 * http://www.sxwcms.be/my-work_portfolio_view_portfolioItem_123.html
 *
 *
 * Folder rewrite
 * http://www.sxwcms.be/blog/topic/topic-title-here/123
 * http://www.sxwcms.be/my-work/portfolio/view/portfolioItem/123
 *
 *
 * Numeric (id)
 * http://www.sxwcms.be/blog/topic/123
 * http://www.sxwcms.be/123
 *
 *
 */