<?php
/**
 * @version   $Id: item.php 10885 2013-05-30 06:31:41Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2016 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * @var $item RokSprocket_Item
 */
?>

<li class="sprocket-features-index-<?php echo $index;?>">
	<?php
		;
		if (($image = $item->getPrimaryImage())):
	?>
	<div class="sprocket-features-img-container" data-slideshow2-image>
		<?php $backgroundImage = $image->getSource(); ?>
		<?php if ($item->getPrimaryLink()) : ?>
			<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>">
				<div class="slider-image" style="<?php echo "background-image: url(" . $backgroundImage . ");" ?>"></div>
			</a>
		<?php else: ?>
			<div class="slider-image" style="<?php echo "background-image: url(" . $backgroundImage . ");" ?>"></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="sprocket-features-content" data-slideshow2-content>
		<div class="sprocket-features-padding">
			<?php if ($parameters->get('features_show_title') && $item->getTitle()) : ?>
				<h2 class="sprocket-features-title">
					<?php echo $item->getTitle(); ?>
				</h2>
			<?php endif; ?>
			<?php if ($parameters->get('features_show_article_text') && ($item->getText() || $item->getPrimaryLink())) : ?>
				<div class="sprocket-features-desc">
					<?php echo $item->getText(); ?>
					<?php if ($item->getPrimaryLink()) : ?>
					<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>" class="readon"><?php rc_e('READ_MORE'); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</li>
