<?php
// $Id $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 * - $body_classes_array: An array of the body classes. This is easier to
 *   manipulate then the string in $body_classes.
 * - $node: Full node object. Contains data that may not be safe. This is only
 *   available if the current page is on the node's primary url.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer_nav: The footer navigation region.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */

/******************** Page Layout ***********************************

//////////////////////////////////////////////////////////////////////////
  $header
//////////////////////////////////////////////////////////////////////////
  $subheader
//////////////////////////////////////////////////////////////////////////
  if($left) $left '  $content_top                   ///  $right
                  '                                 ///
                  '  $content                       ///
                  '                                 /// 
                  '  $content_bottom                ///
///////////////////////////////////////////////////////////////////////////
  $footer_nav
///////////////////////////////////////////////////////////////////////////
  $footer
///////////////////////////////////////////////////////////////////////////
  $closure_region

***************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>

<body class="mainbody">
	<div class="skip"><a href="#maincontent">Skip to main content</a> | <a href="#sitemap">Skip to footer site map</a></div>

<div>
</div>
<div>
</div>

	<div class="bdywrpr">

<!-- start header 996-->

     <?php if ($header): ?>
        <div id="header-blocks" class="region region-header">
          <?php print $header; ?>
        </div> <!-- /#header-blocks -->
      <?php endif; ?>

<div class="hdrwrpr">
  <?php if($logo) : ?>
    <div id="header"><?php print '<a href="'. $front_page .'"><img src="'. $logo .'" /></a>'; ?></div>
  <?php endif ?>
  <div class="hdrttl">
    <a href="<?php print $front_page; ?>"><?php print $site_name ?></a>
    <br />
  </div>
  <div class="hdremblem">
    <!--
    <a href="<?php //print $front_page; ?>">
    <img src="<?php //print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/eop/clear.gif" alt="" /></a>
    <br />
    -->
  </div>
  <div class="hdrflag">
    <a href="<?php print $front_page; ?>">
    <img src="<?php print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/eop/hdr-usa-flag.gif" alt="<?php print $site_name; ?>" /></a>
    <br />
  </div>
  <div class="hdrupdtwrpr">

    <!-- Email sign-up form from original whitehouse.gove site
    <div id="ctl03_pGetUpdates">
        <table cellspacing="0" cellpadding="0" border="0" title="Get Email Updates Form">
            <tr>
                <td><input name="ctl03$txtHeaderEmail" type="text" maxlength="100" id="ctl03_txtHeaderEmail" value="E-mail" onfocus="this.value='',this.style.color= '#333'" class="hdrupdteml" title="E-mail address for updates" /><br /></td>
                <td><input name="ctl03$txtHeaderZip" type="text" maxlength="5" id="ctl03_txtHeaderZip" value="ZIP" onfocus="this.value='',this.style.color= '#333'" class="hdrupdtzip" title="ZIP code for updates" /><br /></td>
                <td><input type="image" name="ctl03$btnGetUpdates" id="ctl03_btnGetUpdates" class="hdrupdtbtn" title="Get updates" src="<?php // print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/eop/btn-get-updates.gif" alt="Get updates" style="border-width:0px; height:21px;width:102px;background: #fff url('<?php // print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/loading.gif') 50% 50% no-repeat;" onclick="PleaseWaitImageButton(this);"/><br /></td>
            </tr>
        </table> </div>
    -->

  <!-- secondary links -->
  <?php if ($secondary_links): ?>
    <div id="secondary" class="clear-block">
      <?php print theme('links', $secondary_links); ?>
    </div> <!-- /#secondary -->
  <?php endif; ?>

  </div><!-- /hdrupdtwrpr -->

  <!-- primary links -->
  <div id='navbar'><div id='navbar-inner'>
  <?php print theme('links', $primary_links, array('class' => 'links primary-links', 'id' => 'topnav'), TRUE); ?>
  </div></div><!-- /navbar /navbar-inner -->

</div>
<!-- end header -->

<!-- sub header 996 -->
  <?php if ($subheader): ?>
    <div id="subheader" class="region region-subheader clear-block">
      <?php print $subheader; ?>
    </div> <!-- /#subheader -->
  <?php endif; ?>

<!-- <div class="subhdrwrpr"> -->
  <!-- mod-searchint332 -->
  <!-- <div id="ctl10_pnlSearch" class="mod-searchint332" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'ctl10_btnSearch')"><?php // print $search_box; ?>[SEARCH BOX HERE]


  <table border="0" cellpadding="0" cellspacing="0" title="Site Search Form">
    <tbody>
      <tr>
      <td><input name="ctl10$txtboxSearch" type="text" maxlength="100" id="ctl10_txtboxSearch" title="Search terms" class="srchbx" /><br /></td>
      <td><input type="image" name="ctl10$btnSearch" id="ctl10_btnSearch" title="Search" class="srchbtnwh" src="<?php // print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/eop/btn-searchwh.gif" alt="Search" style="border-width:0px;" /><br /></td>
      </tr>
    </tbody>
  </table>
					
  </div> -->  <!-- end mod-search -->

  <!-- start breadcrumb 996-->
  <!--
  <div class="subhdr">
    <h4><span class="red">[PRIMARY ITEM]</span> &#8226; [SELECTED TITLE]</h4>
  </div>
  -->
  <!-- end breadcrumb-->

<!-- </div> /subhdrwrpr-->
<!-- end sub header -->

<!-- start grid 996-->
<div id="grid-996" class="gridwrpr">
  <!-- <div class="gridwrpr-inner"> -->

  <?php if($left) : ?>
  <div id="<?php print $left_id ?>">
    <!--    <div class="mod-floatbx" style="margin-top: 0pt;">  TODO: can we get rid of this div? -->
	<!-- left sidebar -->
	<?php print $left; ?>
	<!-- /left sidebar-->
    <!--    </div>  -->
  </div>
  <?php endif; ?>

  <span style="position:absolute;"><a name="maincontent"></a></span>
  
  <div id="<? print $center_id ?>">
										
    <div id="<? print $content_id ?>"><div id="content-inner">

        <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
        <?php endif; ?>

      <?php print $feed_icons; ?>
      <?php if (!empty($title)): ?><h1 class="title <?php if (!empty($node)) : print $node->type ."-title node-title" ; endif; ?>" id="page-title"><?php print $title; ?></h1><?php endif; ?>
      <?php if (!empty($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
      <?php if (!empty($messages)): print $messages; endif; ?>
      <?php if (!empty($help)): print $help; endif; ?>

      <?php if ($content_top): ?>
        <div id="content-top" class="region region-content_top clear-block">
          <?php print $content_top; ?>
        </div> <!-- /#content-top -->
      <?php endif; ?>

      <div id="content-content" class="clear-block">
        <?php print $content; ?>
      </div> <!-- /content-content -->

      <?php if ($content_bottom): ?>
        <div id="content-bottom" class="region region-content_bottom clear-block">
          <?php print $content_bottom; ?>
        </div> <!-- /#content-bottom -->
      <?php endif; ?>

    </div></div><!-- /#content-inner, /#content or /#content-wide -->

  </div><!-- style=background:transparent... -->

<div id="right-col">
    <div>
		<!-- right sidebar-->
		<?php print $right; ?>
		<!-- /right sidebar-->
    </div>

				</div>
				<div class="clear">&nbsp;</div>
  <!-- </div>  --><!-- end gridwrpr-inner -->
</div><!-- end grid -->

<!-- start footer 996-->
<div class="ftrwrpr">

  <!-- start breadcrumb 996-->
  <div class="bcrumbwrpr">
    <!-- You are Here: <a href="http://www.whitehouse.gov">Home</a> &gt; <a href="/Issues/">Issues</a> &gt; Defense  -->
  </div>
  <!-- end breadcrumb-->

  <span style="position:absolute;"><a name="sitemap"></a></span>
  <div class="ftrnav region region-footer_nav clear-block">
    <?php print $footer_nav ?>
  </div>
  <div class="clear"> </div>

<div class="subftrwrpr">
    <!-- <div class="subwhgov">
      <a href="<?php // print $front_page; ?>">
        <img alt="www.whitehouse.gov" src="<?php // print $base_path; ?>/profiles/civic/themes/whitehouse/css/images/eop/sftr-whgov.gif" /> 
      </a> 
    </div> -->
  <div class="subftlnks">
    <div id="footer-wrapper">
      <div id="footer">
        <?php print $footer_message; ?>
        <?php if (!empty($footer)): print $footer; endif; ?>
      </div> <!-- /footer -->
    </div> <!-- /footer-wrapper -->
  </div><!-- subftlnks -->
</div><!-- subftrwrpr -->
</div>

<?php print $closure; ?>

</body>
</html>
