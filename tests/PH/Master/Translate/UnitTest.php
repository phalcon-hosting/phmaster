<?php
/**
 * @author Stephen Hoogendijk
 * @copyright PhalconHosting
 * @license This file is licensed under the proprietary License of PhalconHosting
 */
use \PH\Master\Translate as Translate,
    Phalcon\DI;

/**
 * Class UnitTest
 */
class UnitTest extends \PH\Master\Test\UnitTestCase {

    /**
     * @var \PH\Master\Translate
     */
    private $_translate;

    /**
     * @var array
     */
    private $_translationAsset = array(
        'test'                    =>      'works',
        '$msg test params'        =>      'Test works %d %s'
    );

    /**
     * Setup the test case
     */
    public function setUp() {

        parent::setUp();

        // invalidate all the translation caches before testing
        $this->_cache->delete("translations_xx");

        $this->_translate = new Translate('xx', $this->_translationAsset);

    }

    public function testTranslation() {

        $this->assertEquals('works',
            $this->_translate->translate('test'),
            'Translation without parameter(s) failed'
        );

        $this->assertEquals('Test works 1337 test',
            $this->_translate->translate('$msg test params', array(1337, 'test')),
            'Translation without parameter(s) failed'
        );
    }

    public function testGetTranslations() {
        $this->assertEquals(new \Phalcon\Translate\Adapter\NativeArray(array('content'=>$this->_translationAsset)),
            $this->_translate->getTranslations(),
            'getTranslations does not return the proper translation array!'
        );
    }

    public function testStaticMethods() {
        $this->assertEquals(Translate::translate('test'),
            $this->_translate->getTranslations()->_('test'),
            'Translation static method does not match any know translation methods'
        );

        $this->assertEquals(Translate::_('test'),
            Translate::translate('test'),
            'Static method alias method (Translate::_) failed'
        );
    }
}
