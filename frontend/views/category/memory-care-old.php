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
		<p class="main-text-content text-color-black text-center mb-0 max-w-700 me-auto ms-auto">Learn all about memory care including cost, </br>care offered, and what to ask when touring a community.</p>
	</div>
</section>

<section class="container main-text-content text-color-black pt-4 pt-md-9">
	<div class="row">
		
		<div class="col-12">
			<h2 class="hub-page__title mb-2">What is Memory Care?</h2>
			<?=PageAuthor::widget(['date' => date('F j, Y', filemtime(__FILE__)), 'name' => 'Kitty Ferrantella', 'link' => '#', 'avatar' => '/theme/img/authors/Jackie-Mckoy.png']);?>
		</div>
		
		<div class="col-12 col-md-9">
            <p class="main-text-content text-color-black"> Memory care is needed when a person who has memory impairment can no longer care for themselves. They may or may not be physically able, but cognitively, people with memory impairment cannot manage the day to day of activities of living without supervision to maintain a safe environment.</p>
            <p class="main-text-content text-color-black">There are many types of dementia, such as Alzheimer’s, Lewy Body dementia, Parkinson’s dementia, Huntington’s Disease, memory loss from a traumatic brain injury or stroke. </p>
            <h2 id="care" class="numbered-title mb-2 mb-md-25">Types of Memory Loss</h2>
            <p class="main-text-content text-color-black">Memory loss can be short term where information cannot be retained after just given or forgotten within a few days. Long-term is memory loss of details from a few weeks ago to memories that can go back several decades or to early years. Other memory loss is sensory which is involving the loss of sense; taste, touch, smell, hearing and sight. Working memory allows for processing thoughts and ideas to be able to function throughout the day. Working memory loss affects the ability to process a plan or put together the steps to function cohesively. Memory loss can happen slowly over time or quickly if triggered by an incident or illness.</p>
            <h2 id="care" class="numbered-title mb-2 mb-md-25">How to Know When Help is Needed</h2>
            <p class="main-text-content text-color-black">There are many indicators that a loved one may need more help because of memory impairment. It shocks many families when they come home to visit a parent or grandparent for the holidays and find that they are not doing well. Families may speak on the phone every few days and mom or dad can effectively hold together a brief conversation, but when family comes to visit, it tells another story. </p>
            <p class="main-text-content text-color-black">Some of the telltale signs that all is not well have to do with appearance. Loved ones with memory issues may look disheveled or unkempt. Hair may not be combed, or face may not be clean shaven. They may have lost weight. Clothes are mismatched and may appear dirty. The house is unclean, dishes are stacked in the sink, they may have mail stacked up and there are overdue bills and missed appointments. There may be no food in the refrigerator or it has spoiled. Garbage may not have been taken out, so there may be an odor. Improper food storage and garbage removal may lead to a pest control issue. There may be some dents or dings in the car that they can’t explain. Prescription drugs may not look like they have been taken properly or refilled in a timely manner, or if at all.</p>
            <p class="main-text-content text-color-black">It is important to assess why some of these things may be happening. It may not mean a person has dementia. There could be other underlying issues. If an elder was sick or not feeling well, this may affect memory, especially if they weren’t hydrating, eating properly or taking medications correctly could cause confusion. If there is an undiagnosed urinary tract infection, thyroid issue or a vitamin deficiency could cause confusion or a dementia-like state. It is imperative to make sure proper medical treatment is given and blood work done to rule out any of the above.</p>

            <h2 id="care" class="numbered-title mb-2 mb-md-25">What Accomodations Can I Expect in Memory Care?</h2>
            <p class="main-text-content text-color-black">In memory care communities, studio, one -bedroom and shared (companion) apartments or rooms are offered. They will vary in square footage but will typically be smaller than apartments in assisted living. The apartments are simple in floor plan to help residents who may have depth perception issues because of their memory loss. No apartments in memory care will have a working stove but may have a small kitchenette. Apartments may come furnished or unfurnished. If furnished, apartments will include a bed and a dresser. Residents are encouraged to bring some of their favorite pictures or accessories to make their apartment feel familiar.</p>
            <p class="main-text-content text-color-black">Studio apartments are the most common. It can be an easier transition for some to have a private space. Shared (companion) apartments or rooms may have a shared bathroom. As a resident moves further into their dementia journey, it can be helpful to have a roommate. There is also cost savings for shared (companion) accommodations, which can help conserve funds. The smaller spaces in memory care offer safe, cozy spaces for residents, which are easy for them to navigate. One -and- two -bedroom apartments are rare in memory care for a few reasons. They can be great solutions if a couple both have memory issues and they can stay together. Cost goes up for the larger apartments and too large of a space can confuse residents with memory impairment.</p>
            <p class="main-text-content text-color-black">The area where memory care is in the community is set apart from the rest of the community because it is often secured. Secure memory care means that it is safe for residents who may wander or are elopement risks. It may require a code to enter or exit. Some communities may offer Wander Guard technology. A Wander Guard or a similar system will help a resident from leaving or straying out of a safe zone by alerting staff that a resident is close to the door. The resident has on a bracelet that reacts with an alarm sensor. Other technology with a GPS will tell exactly where a resident is at in the community. </p>

            <h2 id="care" class="numbered-title mb-2 mb-md-25">What Care is Provided in Memory Care?</h2>
            <p class="main-text-content text-color-black">Memory care communities will have a higher staffing ratio than assisted living during all shifts. Staff is specially trained to care for residents with memory impairment. They will have ongoing training. Memory care communities can range in the level of care they provide. Some may manage a lighter care level from early to mid-dementia and other communities will expect to care for a resident until end of life with the help of hospice. Certain behaviors may not be accepted, especially if it puts other residents or staff at risk. A staff member, usually a nurse, will do a thorough assessment prior to acceptance to make sure the community can meet a future resident’s needs.</p>
            <p class="main-text-content text-color-black">Certified Nurse Assistants (CNAs) will do the hands-on caregiving and nurses (LPN, RN) will be onsite and on-call for supervision and medical over-sight 24/7. An on-call physician and/or a nurse practitioner rounding regularly is very convenient. A psychiatrist may also be available. This medical team helps keep the continuity of care consistent for each resident and ready to respond quickly if there is a change of condition. </p>
            <p class="main-text-content text-color-black">Care provided is similar to that in assisted living. Help with activities of daily living, bathing and dressing, grooming, medication management, and toileting. Higher needs can be met with incontinence care and help with eating and mobility. Every community will have care levels, ranging from cueing and reminders to full assistance. It is very important that you understand what is the highest level of care provided and what can the community cannot manage. Knowing this is imperative to making a well-informed decision.</p>
            <p class="main-text-content text-color-black">Memory loss affects each resident differently as the illness progresses. Food intake and hydration are important for every senior. Those with memory loss may have other concerns when it comes to eating. Some may forget how to eat. Swallowing can be an issue and create a choking hazard. Food may need to be presented as mechanically chopped or pureed. Hands may shake and can no longer get a fork from plate to mouth, depth perception could be affected and finding food on the plate is hard to see. Help may be given as reminders, encouragement, special textures or full feeding assistance.</p>

            <h2 id="care" class="numbered-title mb-2 mb-md-25">Memory Care Programming and Life Enrichment</h2>
            <p class="main-text-content text-color-black">Just as important as caring for the physical and medical needs of a resident, so is caring for their emotional, mental and social wellbeing. The memory care community should have programming to address all the six dimensions of wellness that make up all the aspects of living a well-rounded life. These six dimensions, as described by the National Wellness Institute, are; emotional, spiritual, physical, social, intellectual, and occupational.</p>
            <p class="main-text-content text-color-black">Specialized programming daily will meet a memory care resident where they are in their cognitive abilities. Daily opportunities should be available for each resident to achieve their full potential, to recognize and affirm each resident’s positive qualities and strengths and address the resident as the multi-dimensional person who they are. </p>
            <p class="main-text-content text-color-black">Read more at: <a href="https://nationalwellness.org/resources/six-dimensions-of-wellness/">Six Dimensions of Wellness | National Wellness Institute</a></p>
            <p class="main-text-content text-color-black">Different therapies include the senses. Aroma therapy, music, and pet therapy are some programs you will see in memory care. Other programs are art, reminiscing, exercise and movement. Community staff will take great interest in learning the past history of a new resident. This is so staff can understand who they are and what is important to them. Knowing this can help caregivers give personalized care and attention to each resident. It can make a significant difference to a resident in feeling understood when they aren’t able to tell their own story or explain what they need.</p>

            <h2 id="care" class="numbered-title mb-2 mb-md-25">Questions to Ask When Touring a Memory Care Community</h2>
            <p class="main-text-content text-color-black">The questions to ask are similar to <a href="/assisted-living/questions-to-ask/">what to ask when touring an assisted living community</a>, but memory care has its own considerations. Some additional questions to ask are:</p>
            <ul class="check-list">
                <li>What will the day-to-day life of my loved one look like?</li>
                <li>How do you help give purpose to my loved one every day?</li>
                <li>Will daily activities be tailored to my loved one’ interests? How do you determine that?</li>
                <li>What happens if my loved one’s care level exceeds beyond your highest level of care?</li>
                <li>If my loved one needs to move, will you help me find the right placement?</li>
                <li>How secure is this memory care wing? What type of security do you have?</li>
                <li>What type of technology do you use for well-being and accuracy?</li>
                <li>How will you keep me informed about my loved one’s changes? Emergencies?</li>
                <li>Will I be notified if there are any medication changes prescribed for my loved one?</li>
                <li>What is the process for me to discuss my concerns or questions?</li>
                <li>Do you employ full-time nursing staff besides caregivers?</li>
                <li>What medical professionals comprise your medical team in memory care?</li>
                <li>What type of medical services do you provide?</li>
                <li>What type of training does your staff have and how often is additional training provided?</li>
                <li>What is your screening process for caregivers?</li>
                <li>Will staff accompany my loved one to doctor appointments or to the Emergency Room?</li>
            </ul>
		</div>

		<aside class="col-12 col-md-3 mt-4 mt-md-0">
			<div class="sticky-block">
				<?=CategoryContentList::widget(['category_id' => $category_id, 'title' => 'More Memory Care Articles']);?>
			</div>
		</aside>
		
	</div>
</section>

<?=CategoryRelatedPosts::widget(['category_id' => $category_id, 'title' => 'Related Articles', 'not_found_text' => 'No Related Articles']);?>
