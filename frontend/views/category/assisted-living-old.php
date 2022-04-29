<?php

use yii\bootstrap\BootstrapAsset;
use frontend\assets\AppAsset;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
#use yii\widgets\Breadcrumbs;
#use frontend\components\BreadcrumbsNew;
use yii\web\View;
use yii\widgets\Pjax;
use common\models\Users;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\Property;
use yii\widgets\LinkPager;
use frontend\widgets\Breadcrumbs;
use frontend\widgets\CategoryContentList;
use frontend\widgets\PageAuthor;
use frontend\widgets\CategoryRelatedPosts;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $meta['title'];
$this->registerCssFile('@web/theme/css/category-template.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
?>
<section class="hub-page">
	<div class="container hub-page__first-screen">
		<h1 class="d-none d-md-block main-title text-center mb-3 max-w-700 me-auto ms-auto"><?=$meta['h1'];?></h1>
		<p class="main-text-content text-color-black text-center mb-0 max-w-700 me-auto ms-auto">Learn all about assisted living including cost, </br>care offered, and what to ask when touring a community.</p>
	</div>
</section>

<section class="container main-text-content text-color-black pt-4 pt-md-9">
	<div class="row">
		
		<div class="col-12">
			<h2 class="hub-page__title mb-2">What is Assisted Living?</h2>
			<?=PageAuthor::widget(['date' => date('F j, Y', filemtime(__FILE__)), 'name' => 'Kitty Ferrantella', 'link' => '#', 'avatar' => '/theme/img/authors/Jackie-Mckoy.png']);?>
		</div>
		
		<div class="col-12 col-md-9">
			<p class="main-text-content text-color-black">Assisted living is a home residence for seniors who need support on a daily basis. Support can range from needing help with personal care needs, medication reminders or management, meals, and housekeeping, among other things. Assisted living also provides the opportunity for residents to socialize and enjoy activities together. Many assisted living communities provide transportation to medical appointments, shopping, and to community events. </p>
            
            <p class="main-text-content text-color-black">Help with personal care needs, also called activities of daily living (ADLs), include personal care activities such as bathing, showering, dressing, using the restroom, taking medication, mobilizing, and preparing meals. Many assisted living communities also provide incontinence care, diabetic care, and feeding assistance to seniors who need it. Needs vary and are based on the individual, as some seniors need very little help, while others need more. The term “level of care” refers to amount or type of help and care an assisted living community provides. Some assisted living communities have up to six levels of care, while others offer minimal help. </p>

            <h2 id="care" class="numbered-title mb-2 mb-md-25">What care is provided in assisted living?</h2>

            <p class="main-text-content text-color-black">Care in an assisted living community may or may not include nurse oversight. Nurses do the initial assessment and oversee medication distribution. Nurses also coordinate medical care with residents’ physicians. </p>

            <p class="main-text-content text-color-black">All assisted living communities have caregivers managing the day-to-day needs of their residents, and reputable communities are staffed 24/7. Some communities employ caregivers who are Certified Nursing Assistants (CNAs), as well as Medication Technicians, who assist in administering medication to residents.</p>

            <p class="main-text-content text-color-black">Most assisted living communities offer in-house physician or nurse practitioner services, which provide a high level of continuity of care for residents and are an added convenience. A podiatrist or dentist may visit a participating community quarterly. Therapies such as physical, occupational, and speech are also available daily onsite at many senior living establishments. These services and others, such as beautician services, are always optional for residents.</p>

            <h2 id="accomodations" class="numbered-title mb-2 mb-md-25">What accomodations can I expect in assisted living?</h2>

            <p class="main-text-content text-color-black">Assisted living communities come in all sizes. Some present a more homestyle approach with fewer residents in a residential home that may be situated a neighborhood. Other larger communities serve one hundred or more residents.</p>

            <p class="main-text-content text-color-black">Apartment sizes vary from community to community. Most will offer studios, one- and two-bedroom apartments, and companion rooms. Apartments come furnished or unfurnished, though unfurnished is more common, so residents can bring their favorite furniture and wall art.</p>

            <p class="main-text-content text-color-black">Outdoor accommodations may include front porches, patios, gardens, raised bed gardens, or walking paths. There are typically comfortable sitting places, both in the sunshine or in the shade where residents can enjoy the outdoors.</p>

            <h2 id="to-do" class="numbered-title mb-2 mb-md-25">What is there to do in assisted living?</h2>

            <p class="main-text-content text-color-black">Any reputable senior living community offers activities, events, and social outings. A well- organized activities calendar is a special part of community life in assisted living for most seniors. Daily schedules offer things to do and experiences to encounter, as well as options for exercise and physical activity. The good activities director at a senior living community will vary the calendar to meet a wide variety of preferences and interests. Examples of activities include arts and crafts, card games, board games, social games, parties, bingo, and even Wii bowling. More specialized events range from family brunches, holiday and birthday celebrations, movie nights, or live entertainment brought in for all to enjoy onsite. Outings include day trips to local shops, lunching, and dining, as well as stops at nearby theaters, museums, concerts, and other cultural events. Every community is unique in their offerings.</p>

            <p class="main-text-content text-color-black">Amenities often include a fitness center with both equipment and many types of exercise classes. Some communities have pools for aquatic exercising and swimming laps. A beauty and barber shop are very common and a community may even offer other services like manicures and pedicures. Some assisted living centers include spas with sitting whirlpools, as well as massage therapy.</p>

            <h2 id="not-do" class="numbered-title mb-2 mb-md-25">What assisted living does not do</h2>

            <p class="main-text-content text-color-black">Assisted living provides help for residents and their daily care needs. Needs that are more medical such as catheters, IV drug therapies, feeding tubes, and high-level wound care area not included in assisted living care. </p>

            <h2 id="cost" class="numbered-title mb-2 mb-md-25">Is assisted living free?</h2>

            <p class="main-text-content text-color-black">Most assisted living communities require private pay funds for rent and care paid monthly by residents who live there. Many nursing homes do take public assistance or Medicaid as a payor source for custodial care for those who cannot afford to pay but need care.</p>

            <p class="main-text-content text-color-black">For patients who require physical, occupational, and speech therapies after a hospital visit may be eligible to use their Medicare benefit for their skilled nursing stay to receive therapy.</p>

            <h2 id="philosophy" class="numbered-title mb-2 mb-md-25">Assisted living philosophy</h2>

            <p class="main-text-content text-color-black">The focus of assisted living is to care for residents’ whole being: mind, body, and spirit, so residents may need help, but a full and engaging life awaits. Life in assisted living offers opportunities to get excited every day and live life in a community with others. Residents often enjoy close friendships with fellow residents and staff, spending days doing the things they love or trying things they never had time for.</p>

            <h2 id="benefits" class="numbered-title mb-2 mb-md-25">Benefits of assisted living</h2>

            <p class="main-text-content text-color-black">The decision to move into assisted living comes easy for some. Some seniors make the decision because of an unforeseen event or the risk that they may no longer be safe at home. In helping many seniors and their families find the right solutions, so many find themselves asking why they didn’t do it sooner because it just makes sense.</p>

            <p class="main-text-content text-color-black">There are many benefits of assisted living. These advantages include the following:</p>

            <ul class="check-list">
                <li><strong>Mental Health</strong> — Research by the National Institute on Aging (April 2019) claims social isolation and loneliness in older people poses mental and physical health risks, and the detrimental effects of isolation can lead to cognitive decline, depression, and heart disease. See: <a href="https://www.nia.nih.gov/news/social-isolation-loneliness-older-people-pose-health-risks">Social isolation, loneliness in older people pose health risks</a> | National Institute on Aging (nih.gov)</li>
                <li><strong>Activities</strong> — Seniors stay active with things to do and experience every day. The world of an aging senior will often become smaller as everyday abilities or mobility becomes more challenging. In assisted living, a senior can be as independent as they are able to be but with support to make sure they enjoy all the community has to offer.</li>
                <li><strong>Independence</strong> — Many seniors are relieved to have the freedom of not needing to rely on family and being able to decide what they do when they wake up each day with the support available to make it happen.</li>
                <li><strong>Medication Reminders and Management</strong> — According to the National Center for Biotechnology Information, up to 60% of older adults mismanage medications, with a large percentage requiring a trip to the ER when they do. About 140,000 seniors die each year as a result. In assisted living, medication reminders and management are a critical factor for the well-being of every resident. Attention and oversight are given to directions of each prescription, possible side effects, time of day to take medications, and possible drug interactions with other prescription drugs. With seniors taking an average of five to six prescription drugs daily, this oversight is imperative. See: Medication Management of the Community-Dwelling Older Adult - Patient Safety and Quality - <a href="https://www.ncbi.nlm.nih.gov/books/NBK2670/">NCBI Bookshelf (nih.gov)</a></li>
                <li><strong>Nutrition</strong> — Proper nutrition is important to overall health and well-being. In assisted living, creating delicious meals, desserts, and snacks that appeal to a wide variety of palettes is a crucial element in creating memorable dining experiences. Many assisted living communities can cater to special dietary needs.</li>
                <li><strong>Maintenance free living</strong> — Freedom from housekeeping, yard maintenance, cooking, and   laundry frees up a lot of time and work for assisted living residents.</li>
                <li><strong>Safety</strong> — Apartments in assisted living are designed to be senior-friendly. Bathrooms have grab bars and easy to access showers. Emergency pull cords or other kinds of emergency response systems are commonly found in assisted living apartments. Additionally, the entrances in most communities have security measures with greeters at the door, sign-in sheets for all visitors, and an intercom for evening access.</li>
                <li><strong>Medical oversight</strong> — Many assisted living communities provide transportation and coordination of medical care and medical appointments. Thus, proper attention is promptly given to any changes in a resident’s condition.</li>
            </ul>
		</div>

		<aside class="col-12 col-md-3 mt-4 mt-md-0">
			<div class="sticky-block">
				<?=CategoryContentList::widget(['category_id' => $category_id, 'title' => 'More Assisted Living Articles']);?>
			</div>
		</aside>
		
	</div>
</section>

<?=CategoryRelatedPosts::widget(['category_id' => $category_id, 'title' => 'Related Articles', 'not_found_text' => 'No Related Articles']);?>
