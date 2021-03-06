<?php


class ZendX_JQuery_AutoCompleteActionHelperTest extends PHPUnit\Framework\TestCase
{
    protected $_front = null;

    public function setUp()
    {
        $this->_front = Zend_Controller_Front::getInstance();
        $this->_front->resetInstance();

        $request = new Zend_Controller_Request_Simple();
        $this->_front->setRequest($request);

        $response = new Zend_Controller_Response_Cli();
        $this->_front->setResponse($response);
    }

    public function testCallDirectMethodOnHelperSimpleStructure()
    {
        $helper = new ZendX_JQuery_Controller_Action_Helper_AutoComplete();
        $autoCompleteOutput = $helper->direct(
            array("New York", "Bonn", "Tokio"),
            false
        );
        $this->assertEquals("New York\nBonn\nTokio\n", $autoCompleteOutput);
    }

    public function testCallDirectMethodOnHelperKeyValueStructure()
    {
        $helper = new ZendX_JQuery_Controller_Action_Helper_AutoComplete();
        $autoCompleteOutput = $helper->direct(
            array(
                "United States" => "Washington",
                "Germany"       => "Berlin",
                "Japan"         => "Tokio"
            ),
            false
        );
        $this->assertEquals(
            "United States|Washington\nGermany|Berlin\nJapan|Tokio\n",
            $autoCompleteOutput
        );
    }

    public function testCallWithInvalidData()
    {
        $helper = new ZendX_JQuery_Controller_Action_Helper_AutoComplete();
        try {
            $helper->direct("invaliddata", false);
            $this->fail();
        } catch(Zend_Controller_Action_Exception $e) {
        
        }
    }

    public function testValidateData()
    {
        $helper = new ZendX_JQuery_Controller_Action_Helper_AutoComplete();
        $this->assertTrue($helper->validateData(array("New York")));
        $this->assertFalse($helper->validateData("stringinvalid"));
    }
}