<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

use Symfony\Component\Translation\TranslatorInterface;

class DataLangCore
{
    /** @var TranslatorInterface  */
    protected $translator;

    /** @var string */
    protected $locale;

    /** @var array */
    protected $keys;

    /** @var array */
    protected $fieldsToUpdate;

    /** @var array */
    protected $fieldNames;

    /** @var string */
    protected $domain;

    public function __construct(TranslatorInterface $translator, $locale)
    {
        $this->translator = $translator;
        $this->locale = $locale;

        $this->init();
    }

    public function getFieldValue($field, $value)
    {
        $md5Value = md5($value);

        if (isset($this->fieldNames[$field]) && isset($this->fieldNames[$field][$md5Value])) {
            return $this->fieldNames[$field][$md5Value];
        }

        return $value;
    }

    public function getKeys()
    {
        return $this->keys;
    }

    public function getFieldsToUpdate()
    {
        return $this->fieldsToUpdate;
    }

    protected function init()
    {
        $this->fieldNames = array();
    }

    public function slugify($string)
    {
        return strtolower(str_replace(' ', '-', Tools::replaceAccentedChars($string)));
    }
}
