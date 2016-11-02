<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_ROOT . '/components/com_banners/helpers/banner.php';
$baseurl = JUri::base();
$index = 0;
?>
<div class="bannergroup<?php echo $moduleclass_sfx ?>">
<?php if ($headerText) : ?>
	<?php echo $headerText; ?>
<?php endif; ?>

<?php foreach ($list as $item) : ?>
	<?php $index += 1; ?>
	<div class="banneritem">
		<?php $link = JRoute::_('index.php?option=com_banners&task=click&id=' . $item->id);?>
		<?php if ($item->type == 1) :?>
			<?php // Text based banners ?>
			<?php echo str_replace(array('{CLICKURL}', '{NAME}'), array($link, $item->name), $item->custombannercode);?>
		<?php else:?>
			<div class="banneritem_container">
			<?php $imageurl = $item->params->get('imageurl');?>
			<?php $width = $item->params->get('width');?>
			<?php $height = $item->params->get('height');?>
			<?php if (BannerHelper::isImage($imageurl)) :?>
				<?php // Image based banner ?>
				<?php $alt = $item->params->get('alt');?>
				<?php $alt = $alt ? $alt : $item->name; ?>
				<?php $alt = $alt ? $alt : JText::_('MOD_BANNERS_BANNER'); ?>
				<?php if ($item->clickurl) :?>
					<?php // Wrap the banner in a link?>
					<?php $target = $params->get('target', 1);?>
					<?php if ($target == 1) :?>
						<?php // Open in a new window?>
						<a
							href="<?php echo $link; ?>" target="_blank"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?>">
							<div class="banneritem_image">
								<img
									src="<?php echo $baseurl . $imageurl;?>"
									alt="<?php echo $alt;?>"
									<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
									<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
								/>
							</div>
							<?php echo "<div class=\"banneritem_text\">" . $alt . "</div>"; ?>
							<div class="clearfix"></div>
						</a>
					<?php elseif ($target == 2):?>
						<?php // Open in a popup window?>
						<a
							href="<?php echo $link;?>" onclick="window.open(this.href, '',
								'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');
								return false"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?>">
							<div class="banneritem_image">
								<img
									src="<?php echo $baseurl . $imageurl;?>"
									alt="<?php echo $alt;?>"
									<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
									<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
								/>
							</div>
							<?php echo "<div class=\"banneritem_text\">" . $alt . "</div>"; ?>
							<div class="clearfix"></div>
						</a>
					<?php else :?>
						<?php // Open in parent window?>
						<a
							href="<?php echo $link;?>"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?>">
							<div class="banneritem_image">
								<img
									src="<?php echo $baseurl . $imageurl;?>"
									alt="<?php echo $alt;?>"
									<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
									<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
								/>
							</div>
							<?php echo "<div class=\"banneritem_text\">" . $alt . "</div>"; ?>
							<div class="clearfix"></div>
						</a>
					<?php endif;?>
				<?php else :?>
					<?php // Just display the image if no link specified?>
					<div class="banneritem_image">
						<img
							src="<?php echo $baseurl . $imageurl;?>"
							alt="<?php echo $alt;?>"
							<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
							<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
						/>
					</div>
					<?php echo "<div class=\"banneritem_text\">" . $alt . "</div>"; ?>
					<div class="clearfix"></div>
				<?php endif;?>
			<?php elseif (BannerHelper::isFlash($imageurl)) :?>
				<div class="banneritem_image">
					<object
						classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
						codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
						<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
						<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
					>
						<param name="movie" value="<?php echo $imageurl;?>" />
						<embed
							src="<?php echo $imageurl;?>"
							loop="false"
							pluginspage="http://www.macromedia.com/go/get/flashplayer"
							type="application/x-shockwave-flash"
							<?php if (!empty($width)) echo 'width ="' . $width . '"';?>
							<?php if (!empty($height)) echo 'height ="' . $height . '"';?>
						/>
					</object>
				</div>
				<?php echo "<div class=\"banneritem_text\">" . $alt . "</div>"; ?>
				<div class="clearfix"></div>
			<?php endif;?>
			</div>
		<?php endif;?>
		<div class="clearfix"></div>
	</div>
	<?php if ($index%3 == 0) : ?>
		<div class="clearfix"></div>
	<?php endif; ?>
<?php endforeach; ?>

<?php if ($footerText) : ?>
	<div class="bannerfooter">
		<?php echo $footerText; ?>
	</div>
<?php endif; ?>
</div>
