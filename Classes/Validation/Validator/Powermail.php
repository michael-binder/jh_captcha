<?php

namespace Haffner\JhCaptcha\Validation\Validator;

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Validator\SpamShield\AbstractMethod;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Powermail extends AbstractMethod
{
    /**
     * @return bool true if spam recognized
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
     * @throws \TYPO3\CMS\Extbase\Object\Exception
     */
    public function spamCheck(): bool
    {
        // Skip captcha check on confirmation page
        if (
            property_exists($this, 'flexForm')
                && GeneralUtility::_GPmerged('tx_powermail_pi1')['action'] === 'create'
                && $this->flexForm['settings']['flexform']['main']['confirmation'] === '1'
        ) {
            return false;
        }

        $pages = $this->mail->getForm()->getPages();

        foreach ($pages as $page) {
            /** @var Field $field */
            foreach ($page->getFields() as $field) {
                if ($field->getType() === 'JhCaptchaRecaptcha') {
                    /** @var ReCaptchaValidator $reCaptchaValidator */
                    $reCaptchaValidator = GeneralUtility::makeInstance(ReCaptchaValidator::class);
                    $result = $reCaptchaValidator->validate(GeneralUtility::_GP('g-recaptcha-response'));
                    if (!empty($result->getErrors())) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
