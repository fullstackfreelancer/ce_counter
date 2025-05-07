<?php
defined('TYPO3') or die();

call_user_func(function () {
	$frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'LLL:EXT:ce_counter/Resources/Private/Language/locallang.xlf:ce_title',
			'ce_counter',
			'ce-counter-icon'
		],
		'header',
		'after'
	);

	// New palette header
	$GLOBALS['TCA']['tt_content']['palettes']['ce_counter_header'] = array(
		'showitem' => 'header, header_layout, header_position','canNotCollapse' => 1
	);

	$GLOBALS['TCA']['tt_content']['palettes']['ce_counter_settings'] = array(
		'showitem' => 'counter_time, counter_stop, --linebreak--, counter_labels, counter_format','canNotCollapse' => 1
	);

	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['ce_counter'] = 'ce-counter-record';
	$GLOBALS['TCA']['tt_content']['types']['ce_counter'] = [
		'showitem' => '
			--palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
			--palette--;;ce_counter_header,
			subheader,
			--palette--;LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_settings;ce_counter_settings,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
			--palette--;;language,
			--div--;' . $frontendLanguageFilePrefix . 'tabs.access,
			hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
			--palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
			rowDescription,
		'
	];

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [

		'counter_time' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_time',
			'description' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_time.description',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
			],
		],
		'counter_stop' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_stop',
			'description' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_stop.description',
			'config' => [
				'type' => 'check',
				'default' => 1
			],
		],
		'counter_labels' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_labels',
			'description' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_labels.description',
			'config' => [
				'type' => 'input',
				'default' => 'days,hours,minutes,seconds'
			],
		],
		'counter_format' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_format',
			'description' => 'LLL:EXT:ce_counter/Resources/Private/Language/locallang_db.xlf:counter_format.description',
			'config' => [
				'type' => 'input',
				'default' => 'd,h,m,s'
			],
		],

	]);

});
