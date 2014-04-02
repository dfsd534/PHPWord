<?php
/**
 * PHPWord
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2014 PHPWord
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt LGPL
 */

namespace PhpOffice\PhpWord\Tests\Container;

use PhpOffice\PhpWord\Container\Header;

/**
 * Test class for PhpOffice\PhpWord\Container\Header
 *
 * @runTestsInSeparateProcesses
 */
class HeaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * New instance
     */
    public function testConstructDefault()
    {
        $iVal = rand(1, 1000);
        $oHeader = new Header($iVal);

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Container\\Header', $oHeader);
        $this->assertEquals($oHeader->getSectionId(), $iVal);
        $this->assertEquals($oHeader->getType(), Header::AUTO);
    }

    /**
     * Add text
     */
    public function testAddText()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addText('text');

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Text', $element);
        $this->assertCount(1, $oHeader->getElements());
        $this->assertEquals($element->getText(), 'text');
    }

    /**
     * Add text non-UTF8
     */
    public function testAddTextNotUTF8()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addText(utf8_decode('ééé'));

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Text', $element);
        $this->assertCount(1, $oHeader->getElements());
        $this->assertEquals($element->getText(), 'ééé');
    }

    /**
     * Add text break
     */
    public function testAddTextBreak()
    {
        $oHeader = new Header(1);
        $oHeader->addTextBreak();
        $this->assertCount(1, $oHeader->getElements());
    }

    /**
     * Add text break with params
     */
    public function testAddTextBreakWithParams()
    {
        $oHeader = new Header(1);
        $iVal = rand(1, 1000);
        $oHeader->addTextBreak($iVal);
        $this->assertCount($iVal, $oHeader->getElements());
    }

    /**
     * Add text run
     */
    public function testCreateTextRun()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addTextRun();
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\TextRun', $element);
        $this->assertCount(1, $oHeader->getElements());
    }

    /**
     * Add table
     */
    public function testAddTable()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addTable();
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Table', $element);
        $this->assertCount(1, $oHeader->getElements());
    }

    /**
     * Add image
     */
    public function testAddImage()
    {
        $src = __DIR__ . "/../_files/images/earth.jpg";
        $oHeader = new Header(1);
        $element1 = $oHeader->addImage($src);
        $element2 = $oHeader->addMemoryImage($src); // @deprecated

        $this->assertCount(2, $oHeader->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Image', $element1);
    }

    /**
     * Add image by URL
     */
    public function testAddImageByUrl()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addImage(
            'https://assets.mozillalabs.com/Brands-Logos/Thunderbird/logo-only/thunderbird_logo-only_RGB.png'
        );

        $this->assertCount(1, $oHeader->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Image', $element);
    }

    /**
     * Add preserve text
     */
    public function testAddPreserveText()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addPreserveText('text');

        $this->assertCount(1, $oHeader->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\PreserveText', $element);
    }

    /**
     * Add preserve text non-UTF8
     */
    public function testAddPreserveTextNotUTF8()
    {
        $oHeader = new Header(1);
        $element = $oHeader->addPreserveText(utf8_decode('ééé'));

        $this->assertCount(1, $oHeader->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\PreserveText', $element);
        $this->assertEquals($element->getText(), array('ééé'));
    }

    /**
     * Add watermark
     */
    public function testAddWatermark()
    {
        $src = __DIR__ . "/../_files/images/earth.jpg";
        $oHeader = new Header(1);
        $element = $oHeader->addWatermark($src);

        $this->assertCount(1, $oHeader->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Image', $element);
    }

    /**
     * Get elements
     */
    public function testGetElements()
    {
        $oHeader = new Header(1);

        $this->assertInternalType('array', $oHeader->getElements());
    }

    /**
     * Set/get relation Id
     */
    public function testRelationId()
    {
        $oHeader = new Header(1);

        $iVal = rand(1, 1000);
        $oHeader->setRelationId($iVal);
        $this->assertEquals($oHeader->getRelationId(), $iVal);
    }

    /**
     * Reset type
     */
    public function testResetType()
    {
        $oHeader = new Header(1);
        $oHeader->firstPage();
        $oHeader->resetType();

        $this->assertEquals($oHeader->getType(), Header::AUTO);
    }

    /**
     * First page
     */
    public function testFirstPage()
    {
        $oHeader = new Header(1);
        $oHeader->firstPage();

        $this->assertEquals($oHeader->getType(), Header::FIRST);
    }

    /**
     * Even page
     */
    public function testEvenPage()
    {
        $oHeader = new Header(1);
        $oHeader->evenPage();

        $this->assertEquals($oHeader->getType(), Header::EVEN);
    }
}
