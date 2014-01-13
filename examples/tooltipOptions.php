<?php

// Include FML
require_once __DIR__ . '/../FML/autoload.php';

// Create manialink
$maniaLink = new \FML\ManiaLink();

// Create first quad
$firstQuad = new \FML\Controls\Quads\Quad_Emblems();
$maniaLink->add($firstQuad);
$firstQuad->setPosition(-20, 10);
$firstQuad->setSize(20, 20);
$firstQuad->setSubStyle($firstQuad::SUBSTYLE_1);

// Create second quad
$secondQuad = new \FML\Controls\Quads\Quad_Emblems();
$maniaLink->add($secondQuad);
$secondQuad->setPosition(20, 10);
$secondQuad->setSize(20, 20);
$secondQuad->setSubStyle($secondQuad::SUBSTYLE_2);

// Create the tooltip label
$tooltipLabel = new \FML\Controls\Label();
$maniaLink->add($tooltipLabel);
$tooltipLabel->setY(-20);

// Create script
$script = $maniaLink->getScript();

// Add tooltip feature using a single label with different texts per quad
$script->addTooltip($firstQuad, $tooltipLabel, array(\FML\Script\Script::OPTION_TOOLTIP_TEXT => "First Quad"));
$script->addTooltip($secondQuad, $tooltipLabel, array(\FML\Script\Script::OPTION_TOOLTIP_TEXT => "Second Quad"), \FML\Script\Script::OPTION_TOOLTIP_STAYONCLICK);

// Print xml
$maniaLink->render(true);
