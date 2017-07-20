<?php
namespace morhos\test\Russian;

require_once __DIR__.'/../../vendor/autoload.php';

use morphos\Gender;
use morphos\Russian\NounDeclension;

class NounDeclensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider wordsProvider
     */
    public function testDeclensionDetect($word, $animateness, $declension)
    {
        // skip word if it does not have declension
        if ($declension === null) {
            return true;
        }
        $this->assertEquals($declension, NounDeclension::getDeclension($word));
    }

    /**
     * @dataProvider wordsProvider
     */
    public function testInflection($word, $animateness, $declension, $inflected)
    {
        $this->assertEquals($inflected, array_values(NounDeclension::getCases($word, $animateness)));
    }

    public function wordsProvider()
    {
        return array(
            // 1 - Женский, мужской род с окончанием [а, я].
            // 2 - Мужской рода с нулевым или окончанием [о, е],
            // 2 - Среднего рода с окончанием [о, е].
            // 3 - Женский род на мягкий и щипящий согласный.
            array('молния', false, 1, array('молния', 'молнии', 'молние', 'молнию', 'молнией', 'о молние')),
            array('папа', true, 1, array('папа', 'папы', 'папе', 'папу', 'папой', 'о папе')),
            array('слава', false, 1, array('слава', 'славы', 'славе', 'славу', 'славой', 'о славе')),
            array('пустыня', false, 1, array('пустыня', 'пустыни', 'пустыне', 'пустыню', 'пустыней', 'о пустыне')),
            array('вилка', false, 1, array('вилка', 'вилки', 'вилке', 'вилку', 'вилкой', 'о вилке')),
            array('тысяча', false, 1, array('тысяча', 'тысячи', 'тысяче', 'тысячу', 'тысячей', 'о тысяче')),
            array('копейка', false, 1, array('копейка', 'копейки', 'копейке', 'копейку', 'копейкой', 'о копейке')),
            array('батарейка', false, 1, array('батарейка', 'батарейки', 'батарейке', 'батарейку', 'батарейкой', 'о батарейке')),
            array('гривна', false, 1, array('гривна', 'гривны', 'гривне', 'гривну', 'гривной', 'о гривне')),

            array('дом', false, 2, array('дом', 'дома', 'дому', 'дом', 'домом', 'о доме')),
            array('поле', false, 2, array('поле', 'поля', 'полю', 'поле', 'полем', 'о поле')),
            array('кирпич', false, 2, array('кирпич', 'кирпича', 'кирпичу', 'кирпич', 'кирпичем', 'о кирпиче')),
            array('гений', true, 2, array('гений', 'гения', 'гению', 'гения', 'гением', 'о гении')),
            array('ястреб', true, 2, array('ястреб', 'ястреба', 'ястребу', 'ястреба', 'ястребом', 'о ястребе')),
            array('склон', false, 2, array('склон', 'склона', 'склону', 'склон', 'склоном', 'о склоне')),
            array('сообщение', false, 2, array('сообщение', 'сообщения', 'сообщению', 'сообщение', 'сообщением', 'о сообщении')),
            array('общение', false, 2, array('общение', 'общения', 'общению', 'общение', 'общением', 'об общении')),
            array('воскрешение', false, 2, array('воскрешение', 'воскрешения', 'воскрешению', 'воскрешение', 'воскрешением', 'о воскрешении')),
            array('доллар', false, 2, array('доллар', 'доллара', 'доллару', 'доллар', 'долларом', 'о долларе')),
            array('евро', false, 2, array('евро', 'евро', 'евро', 'евро', 'евро', 'о евро')),
            array('фунт', false, 2, array('фунт', 'фунта', 'фунту', 'фунт', 'фунтом', 'о фунте')),
            array('человек', true, 2, array('человек', 'человека', 'человеку', 'человека', 'человеком', 'о человеке')),
            array('год', false, 2, array('год', 'года', 'году', 'год', 'годом', 'о годе')),
            array('месяц', false, 2, array('месяц', 'месяца', 'месяцу', 'месяц', 'месяцем', 'о месяце')),
            array('бремя', false, 2, array('бремя', 'бремени', 'бремени', 'бремя', 'бременем', 'о бремени')),
            array('дитя', false, 2, array('дитя', 'дитяти', 'дитяти', 'дитя', 'дитятей', 'о дитяти')),
            array('путь', false, 2, array('путь', 'пути', 'пути', 'путь', 'путем', 'о пути')),
            // сущ мужского рода с мягким окончанием
            array('гвоздь', false, 2, array('гвоздь', 'гвоздя', 'гвоздю', 'гвоздь', 'гвоздем', 'о гвозде')),
            array('день', false, 2, array('день', 'дня', 'дню', 'день', 'днем', 'о дне')),
            array('камень', false, 2, array('камень', 'камня', 'камню', 'камень', 'камнем', 'о камне')),
            array('рубль', false, 2, array('рубль', 'рубля', 'рублю', 'рубль', 'рублем', 'о рубле')),
            // увеличительная форма
            array('волчище', true, 2, array('волчище', 'волчища', 'волчищу', 'волчище', 'волчищем', 'о волчище')),
            array('полотнище', false, 2, array('полотнище', 'полотнища', 'полотнищу', 'полотнище', 'полотнищем', 'о полотнище')),
            // уменьшительная форма
            array('волчок', false, 2, array('волчок', 'волчка',  'волчку',  'волчок',  'волчком',  'о волчке')),
            array('котёнок', true, 2, array('котёнок', 'котёнка',  'котёнку',  'котёнка',  'котёнком',  'о котёнке')),
            array('станок', false, 2, array('станок', 'станка',  'станку',  'станок',  'станком',  'о станке')),
            // Адъективное склонение (от прилагательных и причастий)
            // мужской род
            array('выходной', false, null, array('выходной', 'выходного', 'выходному', 'выходной', 'выходным', 'о выходном')),
            array('двугривенный', false, null, array('двугривенный', 'двугривенного', 'двугривенному', 'двугривенный', 'двугривенным', 'о двугривенном')),
            array('рабочий', false, null, array('рабочий', 'рабочего', 'рабочему', 'рабочего', 'рабочим', 'о рабочем')),
            // средний род
            array('животное', true, null, array('животное', 'животного', 'животному', 'животное', 'животным', 'о животном')),
            array('подлежащее', false, null, array('подлежащее', 'подлежащего', 'подлежащему', 'подлежащее', 'подлежащим', 'о подлежащем')),
            // женский род
            array('запятая', false, null, array('запятая', 'запятой', 'запятой', 'запятую', 'запятой', 'о запятой')),
            array('горничная', true, null, array('горничная', 'горничной', 'горничной', 'горничную', 'горничной', 'о горничной')),
            array('заведующая', true, null, array('заведующая', 'заведующей', 'заведующей', 'заведующую', 'заведующей', 'о заведующей')),

            array('ночь', false, 3, array('ночь', 'ночи', 'ночи', 'ночь', 'ночью', 'о ночи')),
            array('новость', false, 3, array('новость', 'новости', 'новости', 'новость', 'новостью', 'о новости')),
        );
    }

    /**
     * @dataProvider immutableWordsProvider
     */
    public function testImmutableWords($word)
    {
        $this->assertFalse(NounDeclension::isMutable($word, false));
    }

    public function immutableWordsProvider()
    {
        return array(
            array('авеню'),
            array('атташе'),
            array('бюро'),
            array('вето'),
            array('денди'),
            array('депо'),
            array('жалюзи'),
            array('желе'),
            array('жюри'),
            array('интервью'),
            array('какаду'),
            array('какао'),
            array('кафе'),
            array('кашне'),
            array('кенгуру'),
            array('кино'),
            array('клише'),
            array('кольраби'),
            array('коммюнике'),
            array('конферансье'),
            array('кофе'),
            array('купе'),
            array('леди'),
            array('меню'),
            array('метро'),
            array('пальто'),
            array('пенсне'),
            array('пианино'),
            array('плато'),
            array('портмоне'),
            array('рагу'),
            array('радио'),
            array('самбо'),
            array('табло'),
            array('такси'),
            array('трюмо'),
            array('фортепиано'),
            array('шимпанзе'),
            array('шоссе'),
            array('эскимо'),
            array('галифе'),
            array('монпансье'),
        );
    }

	/**
	 * @dataProvider gendersProvider()
	 */
    public function testGenderDetection($word, $gender)
	{
		$this->assertEquals($gender, NounDeclension::detectGender($word));
	}

	public function gendersProvider()
	{
		return [
			['вилка', Gender::FEMALE],
			['копейка', Gender::FEMALE],
			['кирпич', Gender::MALE],
			['рубль', Gender::MALE],
			['волчище', Gender::NEUTER],
			['бремя', Gender::NEUTER],
			['человек', Gender::MALE],
			['новость', Gender::FEMALE],
		];
	}
}