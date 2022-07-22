<?php

use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

use Carbon\carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Article 1
        $newpost = App\Models\Post::create([
            "id" => 1,
            "post_title" => "Facebook Removes Trump Ad Over 'Nazi Hate Symbol'",
            "post_name" => "facebook-removes-trump-ad-over-nazi-hate-symbol",
            "post_summary" => html_entity_decode("&lt;p&gt;Facebook says it has removed adverts for US President Donald Trump&apos;s re-election campaign that featured a symbol used in Nazi Germany.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;The company said the offending ad contained an inverted red triangle similar to that used by the Nazis to label opponents such as communists.&lt;/p&gt;&lt;p&gt;Mr Trump&apos;s campaign team said they were aimed at the far-left activist group antifa, which it said uses the symbol.&lt;/p&gt;&lt;p&gt;Facebook said the ads violated its policy against organised hate.&lt;/p&gt;&lt;p&gt;&quot;We don&apos;t allow symbols that represent hateful organisations or hateful ideologies unless they are put up with context or condemnation,&quot; the social network&apos;s head of security policy, Nathaniel Gleicher, said on Thursday.&lt;/p&gt;&lt;p&gt;He added: &quot;That&apos;s what we saw in this case with this ad, and anywhere that that symbol is used we would take the same actions.&quot;&lt;/p&gt;&lt;p&gt;&lt;figure class=&quot;figureClass&quot;&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/180D5/production/_112971589_hi062017586.jpg&quot; style=&quot;width: 624px; height: 396px;&quot; alt=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot; title=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot;&gt;&lt;figcaption class=&quot;captionClass&quot;&gt;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&lt;/figcaption&gt;&lt;/figure&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The ads, which were posted on the site on pages belonging to President Trump and Vice-President Mike Pence, were online for about 24 hours and had received hundreds of thousands of views before they were taken down.&lt;/p&gt;&lt;p&gt;&quot;The inverted red triangle is a symbol used by antifa, so it was included in an ad about antifa,&quot; Tim Murtaugh, a spokesman for the Trump campaign, said in a statement.&lt;/p&gt;&lt;p&gt;&quot;We would note that Facebook still has an inverted red triangle emoji in use, which looks exactly the same,&quot; he added.&lt;/p&gt;&lt;p&gt;Mr Trump has recently accused antifa of starting riots at street protests across the US over the death in police custody of African American George Floyd.&lt;/p&gt;&lt;p&gt;The president said last month that he would designate the anti-fascist group a &quot;domestic terrorist organisation&quot;, although legal experts have questioned his authority to do so.&lt;/p&gt;&lt;p&gt;Antifa is a far left protest movement that opposes neo-Nazis, fascism, white supremacists and racism. It is considered to be a loosely organised group of activists with no leaders.&lt;/p&gt;&lt;p&gt;Most members decry what they see as the nationalistic, anti-immigration and anti-Muslim policies of Mr Trump.&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "mark-zuckerberg-tLXSZlvI6H.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-19 00:14:49",
            "updated_at" => "2020-06-19 00:14:49"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([2,3,4,5,6,7]);

        // Sample Article 2
        $newpost = App\Models\Post::create([
            "id" => 2,
            "post_title" => "Tech Takeovers Feed Into China Cold War Fears",
            "post_name" => "tech-takeovers-feed-into-china-cold-war-fears",
            "post_summary" => html_entity_decode("&lt;p&gt;The UK government is planning new measures to restrict foreign takeovers on national security grounds.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;h3&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;But security experts caution the UK has been late to the issue.&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;It comes amid growing concern about the risk of China buying high-tech companies, especially in the economic turmoil resulting from the coronavirus pandemic.&lt;/p&gt;&lt;p&gt;At the height of the crisis, a boardroom manoeuvre nearly went unnoticed.&lt;/p&gt;&lt;p&gt;And it flared up into a row that goes to the heart of on an increasingly contentious issue - has the UK failed to stop high-tech industries passing into Chinese hands?&lt;/p&gt;&lt;h3&gt;Taking control&lt;/h3&gt;&lt;p&gt;In 2017, Imagination Technologies, a Hertfordshire-based company at the cutting edge of computer-chip design, whose tech is used on iPhones, was bought by Canyon Bridge Partners, a private equity firm based in the Cayman Islands.&lt;/p&gt;&lt;p&gt;But 99% of the funds for the purchase came from China Reform, backed by the state in Beijing.&lt;/p&gt;&lt;p&gt;And this spring, Canyon Bridge Partners tried to install new directors linked to China Reform.&lt;/p&gt;&lt;p&gt;One of those to raise the alarm, Sir Hossein Yassaie, a former chief executive of the company, feared assurances it would not be moved to China were at risk of being broken.&lt;/p&gt;&lt;p&gt;&quot;It looked like there was an attempt to basically change the ownership and control of the company,&quot; he told a documentary made for BBC Radio 4 .&lt;/p&gt;&lt;p&gt;&quot;My stance on Imagination is fundamentally about making sure a very important ecosystem... is maintained as an independent, properly governed supplier.&quot;&lt;/p&gt;&lt;p&gt;The issue was taken up by Tom Tugendhat MP, who chairs the Foreign Affairs Select Committee, which held a hearing in May.&lt;/p&gt;&lt;p&gt;Canyon Bridge denied China had any untoward influence over the purchase or its activities, arguing the decisions were purely commercial.&lt;/p&gt;&lt;p&gt;And some of the changes were halted.&lt;/p&gt;&lt;p&gt;But those involved believe it was an indication of a wider problem.&lt;/p&gt;&lt;p&gt;&quot;This is just part of an incremental process where technology is being moved out of the UK, and out of the West, and towards China,&quot; Mr Tugendhat says.&lt;/p&gt;&lt;h3&gt;&apos;World changed&apos;&lt;/h3&gt;&lt;p&gt;Has the UK been too ready to allow some of its &quot;crown jewel&quot; technology companies to be sold into foreign hands?&lt;/p&gt;&lt;p&gt;&quot;The simple answer unfortunately is, &apos;Yes.&apos;&quot; Sir Hossein says.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/170BC/production/_112969349_uk.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;And Elisabeth Braw, of the Royal United Services Institute think tank, believes many other cases in which cutting edge technology have shifted to China have gone unreported.&lt;/p&gt;&lt;p&gt;&quot;The UK has been late to understand this,&quot; she says.&lt;/p&gt;&lt;p&gt;&quot;It sort of goes against this idea that globalisation is a force for good, if you start saying, &apos;Well, we need to scrutinise foreign investors.&apos;&lt;/p&gt;&lt;p&gt;But actually the world has changed and China is exploiting globalisation for its own gains.&quot;&lt;/p&gt;&lt;p&gt;Theresa May&apos;s government announced plans to look at the issue in 2018.&lt;/p&gt;&lt;p&gt;A bill promising new powers to assess mergers and takeovers was promised in the Queen&apos;s Speech last December.&lt;/p&gt;&lt;p&gt;And in May, Prime Minister Boris Johnson said parliamentarians were &quot;right to be concerned&quot; about the buying up of UK technology by countries that had &quot;ulterior motives&quot;, and promised new measures in the coming weeks.&lt;/p&gt;&lt;p&gt;Others have already acted.&lt;/p&gt;&lt;p&gt;The purchase of a robotics manufacturer by a Chinese company led Germany in 2017 to place new restrictions on takeovers.&lt;/p&gt;&lt;p&gt;US intelligence officials have also increasingly focused on looking for a hidden hand from the Chinese state in business deals.&lt;/p&gt;&lt;p&gt;&quot;You might see an acquisition and on its face it makes all the sense in the world,&quot; US National Counterintelligence and Security Center director Bill Evanina told BBC News.&lt;/p&gt;&lt;p&gt;&quot;But there needs to be intelligence services peeling back that onion to identify who the backdoor owners are and who the financiers of that acquisition are.&quot;&lt;/p&gt;&lt;p&gt;Mr Evanina says that, after having been &quot;a little bit slow, in the last two to three years&quot;, the US government has become more active in warning the private sector.&lt;/p&gt;&lt;p&gt;In the UK, MI5 plays a similar role and informs decisions about whether technology takeovers are in the national interest - but few have been stopped.&lt;/p&gt;&lt;h3&gt;Strategic advantage&lt;/h3&gt;&lt;p&gt;One of the more surprising rows came after the gay dating site Grindr was purchased by a Chinese company.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/6334/production/_112969352_china.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The US raised national security concerns because of the fear the personal data could be used to compromise or influence individuals.&lt;/p&gt;&lt;p&gt;And the company was eventually sold.&lt;/p&gt;&lt;p&gt;&quot;The regulator realised that having that information at the disposal of the Chinese government ultimately was a very bad idea for US national security,&quot; Ms Braw says.&lt;/p&gt;&lt;p&gt;&quot;We need to change our understanding of which companies are vital to national security and treat them just like we treated defence companies in the Cold War&quot;.&lt;/p&gt;&lt;p&gt;One concern for Mr Evanina is the extent to which China can use a combination of acquisitions, its own technology companies and cyber-espionage to build up large databases of personal information.&lt;/p&gt;&lt;p&gt;&quot;The ability to have information on every human in the world that that human doesn&apos;t even have on themselves provides them with a strategic advantage, not only from an espionage perspective but a compromise perspective [and] understanding plans and intentions of companies,&quot; he says.&lt;/p&gt;&lt;p&gt;&lt;i&gt;The New Tech Cold War will be broadcast on BBC Radio 4 at 11:00 on Friday and again on Tuesday at 16:00&lt;/i&gt;&lt;/p&gt;"),
            "meta_description" => "The UK government is planning new measures to restrict foreign takeovers on national security grounds.",
            "meta_keyword" => "Tecnhology, China, United Kindom",
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "ice-YVVuinc615.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-19 00:44:14",
            "updated_at" => "2020-06-19 00:44:14"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([3,8,9]);

        // Sample Article 3
        $newpost = App\Models\Post::create([
            "id" => 3,
            "post_title" => "Joy Is A Net Of Love By Which You Can Catch Souls",
            "post_name" => "joy-is-a-net-of-love-by-which-you-can-catch-souls",
            "post_content" => html_entity_decode("&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;My first reaction is what beauty? I&rsquo;ve definitely crossed over to the invisible side. I rather prefer it that way&mldr;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;My whole life my weight has fluctuated quite a bit and my self-image with it. When I&rsquo;ve been fat, I&rsquo;ve been ugly &mdash; at least in my mind.&lt;/p&gt;&lt;p&gt;I noticed that the more weight I gained, the less teasing or ogling I&rsquo;d get from boys and men. Being fat was safer, damn it. I liked being safe. I hid there.&lt;/p&gt;&lt;p&gt;But at different times I would go on diets and lose weight. That happened in my late twenties, when I went down to what I weighted in sixth grade after the summer diet my grandmother put me on.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://atbs.bk-ninja.com/suga/wp-content/uploads/2019/10/crook-maker-1581631-unsplash-1.jpg&quot; style=&quot;width: 645px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;h3&gt;Connecting the dots&lt;/h3&gt;&lt;p&gt;I feel the connection between the colorful visuals and the magical vibrant world I&rsquo;ve created in my writing. The pictures reflect who I am as a creative spirit.&lt;/p&gt;&lt;p&gt;This process has nudged me back from the ledge of self-loathing, especially where photos are concerned. Going forward in my life necessitates being seen in person, on paper, and perhaps even in some forms of media.&lt;/p&gt;&lt;p&gt;Yes, my beauty is about a lot more than gorgeous photos. But if it took seeing myself through Barbara&rsquo;s eyes to get on board with my full, vibrant, impish, playful, radiant self, so be it.&lt;/p&gt;&lt;p&gt;Now that I am &ldquo;out&rdquo; so to speak, it&rsquo;s up to me to feed myself with beautiful images and stories of women close to me in age who are enjoying their fine physical selves and letting others see them through their eyes, not vice versa.&lt;/p&gt;&lt;p&gt;Let&rsquo;s unsubscribe from magazine culture and sign up for honoring ourselves in the full glory of just how good it feels to be alive in our skins, with our eyes, our hair, our unique ways of moving and being and shining.&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "uriel-soberanes-MxVkWPiJALs-unsplash-e1571990517626-800x400-eUN6hq0FsQ.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-19 00:56:41",
            "updated_at" => "2020-06-19 00:56:41"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([3,10,11,12]);

        // Sample Article 4
        $newpost = App\Models\Post::create([
            "id" => 4,
            "post_title" => "The World Caters To Average People And Mediocre Lifestyles",
            "post_name" => "the-world-caters-to-average-people-and-mediocre-lifestyles",
            "post_content" => html_entity_decode("&lt;p&gt;Tolerably much and ouch the in began alas more ouch some then accommodating flimsy wholeheartedly after hello slightly the that cow pouted much a goodness bound rebuilt poetically jaguar groundhog.&lt;/p&gt;&lt;h3&gt;Design is future&lt;/h3&gt;&lt;p&gt;Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.&lt;/p&gt;&lt;p&gt;Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.&lt;/p&gt;&lt;p&gt;Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted flirtatiously as beaver beheld above forward energetic across this jeepers beneficently cockily less a the raucously that magic upheld far so the this where crud then below after jeez enchanting drunkenly more much wow callously irrespective limpet.&lt;/p&gt;&lt;p&gt;Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively dachshund.&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;The advance of technology is based on making it fit in so that you don&apos;t really even notice it, so it&apos;s part of everyday life.&lt;br&gt;B. Johnso&lt;/blockquote&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "news-EvOoOp7KPL.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-04-09 00:11:12",
            "updated_at" => "2020-04-09 00:11:12"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([3,12,13,14]);

        // Sample Article 5
        $newpost = App\Models\Post::create([
            "id" => 5,
            "post_title" => "Travel And Transportation During The Coronavirus Pandemic",
            "post_name" => "travel-and-transportation-during-the-coronavirus-pandemic",
            "post_content" => html_entity_decode("&lt;p&gt;Strech lining hemline above knee burgundy glossy silk complete hid zip little catches rayon. Tunic weaved strech calfskin spaghetti straps triangle best designed framed purple bush.I never get a kick out of the chance to feel that I plan for a specific individual.&lt;/p&gt;&lt;p&gt;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove. A collection of textile samples lay spread out on the table &ndash; Samsa was a travelling salesman &ndash; and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.&lt;/p&gt;&lt;p&gt;You always pass failure on the way&lt;/p&gt;&lt;p&gt;It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;YOUR POSITIVE ACTION COMBINED WITH POSITIVE THINKING RESULTS IN SUCCESS.&lt;/blockquote&gt;&lt;p&gt;Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&lt;/p&gt;&lt;p&gt;On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &ldquo;and&rdquo; and the Little Blind Text should turn around and return to its own, safe country.&lt;/p&gt;&lt;h3&gt;Welcome to the New Normal?&lt;/h3&gt;&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.&lt;/p&gt;&lt;p&gt;Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. &ldquo;How about if I sleep a little bit longer and forget all this nonsense&rdquo;, he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn&rsquo;t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.&lt;/p&gt;&lt;p&gt;Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "pilot-QH4Ixezl2z.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-05-18 00:11:12",
            "updated_at" => "2020-05-18 00:11:12"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([4,15,16]);

        // Sample Article 6
        $newpost = App\Models\Post::create([
            "id" => 6,
            "post_title" => "Refurbished Devices Marketplace Reebelo Bags Seed Funding",
            "post_name" => "refurbished-devices-marketplace-reebelo-bags-seed-funding",
            "post_content" => html_entity_decode("&lt;p&gt;Reebelo, a marketplace for pre-loved devices, has raised an undisclosed amount of seed funding in a round led by Germany-based June Fund.&lt;/p&gt;&lt;p&gt;Early-stage VC firm Antler also participated in the round, according to a statement. Singapore-based Reebelo was part of Antler&rsquo;s third cohort of startups and was a graduate of HyperSpark, StartupX&rsquo;s sustainability pre-accelerator run in partnership with investment giant Temasek.&lt;/p&gt;&lt;p&gt;According to a 2018 study by the National Environment Agency of Singapore, the city-state produces 60,000 tons of e-waste annually, and only 6% of that gets recycled. To help reduce that number, Reebelo&rsquo;s recommerce marketplace enables consumers in Singapore to buy or sell used smartphones, tablets, and notebooks.&lt;/p&gt;&lt;p&gt;Recommerce, or reverse commerce, refers to the buying and selling of pre-owned goods, mainly electronic devices.&lt;/p&gt;&lt;p&gt;How is the startup different? Some recommerce players in Asia include Moby and Red White Mobile in Singapore, Budli in India, and Laku6 in Indonesia.&lt;/p&gt;&lt;p&gt;At its core, Reebelo is a company that buys used electronics from enterprises and individuals and then refurbishes and tests the devices before listing them on the website. The registered secondhand goods dealer also offers extended warranties to give customers peace of mind.&lt;/p&gt;&lt;p&gt;Under its partnership with environmental charity One Tree Planted, the startup said that one tree is planted for every device sold on its platform.&lt;/p&gt;&lt;p&gt;What are its challenges? So far, most people upgrade their devices once newer models are released, a spokesperson for the company told Tech in Asia. Nowadays, broken devices are also thrown away rather than repaired.&lt;/p&gt;&lt;p&gt;The company aims to change this behavior by allowing customers to sell their used devices for cash, giving their older gadgets a new lease on life.&lt;/p&gt;&lt;p&gt;&ldquo;Reebelo&rsquo;s ambitious vision is to build the circular economy for electronics,&rdquo; Philip Franta, founder and CEO at Reebelo, said. &ldquo;[We&rsquo;re trying] to change the way people consume tech devices at a more sustainable pace &ndash; one device at a time.&rdquo;&lt;/p&gt;&lt;p&gt;What&rsquo;s the opportunity? Reebelo&rsquo;s addressable market size in the region, according to the company, stands at US$4.2 billion. To capture a larger share of this, the startup aims to expand into new business lines such as device rentals and offer bundled business phones and laptops for companies.&lt;/p&gt;&lt;p&gt;It also plans to enter other markets across Asia Pacific and add support for more electronics categories in the future.&lt;/p&gt;&lt;p&gt;How much traction has it gotten? The startup claims to have served more than 210,000 users on its platform since January and is &ldquo;aiming to keep growing in a sustainable way month on month.&rdquo;&lt;/p&gt;&lt;p&gt;Who are the team members? The startup was founded just last year by Franta and Rastouil Fabien.&lt;/p&gt;&lt;p&gt;Franta previously served as chief business development officer for German healthtech firm Media4Care, while chief product officer Fabien served as an innovation consultant in France.&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "Antler2020ProfileShots-DSC_5149-MlQw2wMMxA.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-05-17 09:11:12",
            "updated_at" => "2020-05-17 09:11:12"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([2,18]);

        // Sample Article 7
        $newpost = App\Models\Post::create([
            "id" => 7,
            "post_title" => "Singapore Fintech Startup Raises Seed Funding To Digitize Corporate Loans",
            "post_name" => "singapore-fintech-startup-raises-seed-funding-to-digitize-corporate-loans",
            "post_content" => html_entity_decode("&lt;p&gt;Singapore-based iLex, which aims to transform the corporate lending market, announced that it has raised an undisclosed amount of seed funding from strategic investors in France, Hong Kong, Singapore, and the US.&lt;/p&gt;&lt;p&gt;The startup, which was launched just last year, wants to create an end-to-end digital trading platform for primary syndicated loans and secondary loans. To do this, it plans to create a data analytics tool to help participants make informed credit decisions. As transactions increasingly go online, it also aims to automate deal workflows and offer secure online trading and communications.&lt;/p&gt;&lt;p&gt;The market participants it currently supports include banks, private debt funds, pension funds, asset managers, life insurers, hedge funds, and sovereign wealth funds, among others.&lt;/p&gt;&lt;p&gt;The new funds, ILex said, will be used to develop the first version of its platform, which will feature its own AI matching engine, trading protocols, and data analytics tool.&lt;/p&gt;&lt;p&gt;What problem is it solving? While digitization has already occurred for some asset classes like equities and foreign exchanges, the corporate loan market still largely relies on inefficient manual processes, iLex CEO and founder Bertrand Billon said.&lt;/p&gt;&lt;p&gt;According to the company, the pain points in the market are evident: constrained market reach due to limited resources, lack of liquidity in secondary lending, low-level price discovery, limited market data, and compliance and operational risks.&lt;/p&gt;&lt;p&gt;To tackle these issues, the startup&rsquo;s digital solutions will help users access global deals through its AI matching system, the company said in a statement. The firm will also automate trading execution &ndash; through productivity tools and a centralized audit trail &ndash; and will offer real-time data visualization as well as loan pricing and benchmarking mechanisms so users can gain deep market insights.&lt;/p&gt;&lt;p&gt;&ldquo;I believe our difference lies in the technology that is driving our solutions and data offerings and, importantly, our strategic partnerships with industry players,&rdquo; Billon said.&lt;/p&gt;&lt;p&gt;The company has so far formed partnerships with London-based information provider IHS Markit and financial data provider Refinitiv.&lt;/p&gt;&lt;p&gt;What&rsquo;s the opportunity? In Asia Pacific, the primary syndicated loans market was worth around US$700 billon last year, while the secondary loans market was estimated at around US$50 billon, according to iLex.&lt;/p&gt;&lt;p&gt;Over the last five years, there have been 1,200 active lenders and over 12,000 borrowers in the region accessing capital through syndicated transactions.&lt;/p&gt;&lt;p&gt;But while corporate lending drives the overall economy, being the second-largest source of funding for businesses, less than 1% of fintech investments have gone into this sector, the company observed. ILex therefore positions itself as a pioneer in digitizing the industry.&lt;/p&gt;&lt;p&gt;What are its challenges? As with any other digital marketplace, iLex recognizes that it has to work hard to drive the adoption of its platform and increase deal flow and volumes.&lt;/p&gt;&lt;p&gt;To do this, it will focus on attracting and retaining sell-side arrangers and buy-side investors to become a &ldquo;must-have&rdquo; tool for market participants, the company said.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "ilex-fw5IGRVDPj.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-19 20:11:12",
            "updated_at" => "2020-06-19 20:11:12"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([2,18,19]);

        // Sample Article 8
        $newpost = App\Models\Post::create([
            "id" => 8,
            "post_title" => "Envato - Top Digital Assets And Services",
            "post_name" => "envato-top-digital-assets-and-services",
            "post_summary" => html_entity_decode("&lt;p&gt;Join millions and bring your ideas and projects to life with Envato - the world&apos;s leading marketplace and community for creative assets and creative people.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Millions of people around the world choose our marketplace, studio and courses to buy files, hire freelancers, or learn the skills needed to build websites, videos, apps, graphics and more.&lt;/p&gt;&lt;p&gt;We&rsquo;re a values-based organization focused on community, entrepreneurship, diversity, and integrity. Envato is growing fast, with over 7 million community members in 2016, and we were named one of Australia&rsquo;s coolest companies for women and coolest companies in tech in 2015.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://localhost:8000/image/envato1-TDIvDnwMvl.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;We&rsquo;ve got a lot going on at Envato, so here&rsquo;s the overview of our main products and marketplaces:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Envato Market is a collection of marketplaces for creative digital assets. This includes:&lt;/li&gt;&lt;li&gt;ThemeForest (website templates and WordPress themes)&lt;/li&gt;&lt;li&gt;CodeCanyon (Code, Plugins, and mobile)&lt;/li&gt;&lt;li&gt;VideoHive (motion graphics)&lt;/li&gt;&lt;li&gt;AudioJungle (stock music and audio)&lt;/li&gt;&lt;li&gt;GraphicRiver (graphics, vectors, and illustrations)&lt;/li&gt;&lt;li&gt;PhotoDune (photography)&lt;/li&gt;&lt;li&gt;3DOcean (3D models and materials)&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Reource: &lt;a href=&quot;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&quot; target=&quot;_blank&quot;&gt;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&lt;/a&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "envato-logo-vector-download-UiJ9Fc7bdT.jpg",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-20 00:00:13",
            "updated_at" => "2020-06-20 00:00:13"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([5,21,22,23]);

        // Sample Article 9
        $newpost = App\Models\Post::create([
            "id" => 9,
            "post_title" => "Bootstrap 5 Alpha Finally Launched!",
            "post_name" => "bootstrap-5-alpha-finally-launched",
            "post_summary" => html_entity_decode("&lt;p&gt;Bootstrap 5&rsquo;s very first alpha has arrived! We&rsquo;ve been working hard for several months to refine the work we started in v4, and while we&rsquo;re feeling great about our progress, there&rsquo;s still even more to do.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&#x3C;p&#x3E;We&#x2019;ve been focused on making the migration from v4 to v5 more approachable, but we&#x2019;ve also not been afraid to step away from what&#x2019;s outdated or no longer appropriate. As such, we&#x2019;re very happy to say that with v5, Bootstrap no longer depends on jQuery and we&#x2019;ve dropped support for Internet Explorer. We&#x2019;re sharpening our focus on building tools that are more future-friendly, and while we&#x2019;re not fully there yet, the promise of CSS variables, faster JavaScript, fewer dependencies, and better APIs certainly feel right to us.&#x3C;/p&#x3E;&#x3C;p&#x3E;Before you jump to updating, please remember v5 is now in alpha&#x2014;breaking changes will continue to occur until our first beta. We haven&#x2019;t finished adding or removing everything, so check for open issues and pull requests as you have questions or feedback.&#x3C;/p&#x3E;&#x3C;p&#x3E;Now let&#x2019;s dig in with some highlights!&#x3C;/p&#x3E;&#x3C;h3&#x3E;New look and feel&#x3C;/h3&#x3E;&#x3C;p&#x3E;We&#x2019;ve built on the improvements to our docs homepage in v4.5.0 with an updated look and feel for the rest of our docs. Our docs pages are no longer full-width to improve readability and make our site feel less app-like and more content-like. In addition, we&#x2019;ve upgraded our sidebar to use expandable sections (powered by our own Collapse plugin) for faster navigation.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-home.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;We&#x2019;re also sporting a brand new logo! More on that when v5 goes stable, but suffice to say we wanted to give the ol&#x2019; B in a rounded square a small upgrade.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-new-logo.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;Inspired by the CSS that created the very beginnings of this project, our logo embodies the feeling of a rule set&#x2014;style bounded by curly braces. We love it and think you will, too. Expect to see it roll out to v4&#x2019;s documentation, our blog, and more over time as we continue to refine things and ship new releases.&#x3C;/p&#x3E;&#x3C;h3&#x3E;jQuery and JavaScript&#x3C;/h3&#x3E;&#x3C;p&#x3E;jQuery brought unprecedented access to complex JavaScript behaviors to millions (billions?) of people over the last decade and a half. Personally, I&#x2019;m forever grateful for the empowerment and support it gave me to continue writing front-end code, learning new things, and embracing plugins from the community. Perhaps most importantly, it&#x2019;s forever changed JavaScript itself, and that in itself is a monument to jQuery&#x2019;s success. Thank you to every jQuery contributor and maintainer who made that possible for folks like me.&#x3C;/p&#x3E;&#x3C;p&#x3E;Thanks to advancement made in front-end development tools and browser support, we&#x2019;re now able to drop jQuery as a dependency, but you&#x2019;d never notice otherwise. This migration was a huge undertaking by @Johann-S, our primary JavaScript maintainer these days. It marks one of the largest changes to the framework in years and means projects built on Bootstrap 5 will be significantly lighter on file size and page load moving forward.&#x3C;/p&#x3E;&#x3C;p&#x3E;In addition to dropping jQuery, we&#x2019;ve made a handful of other changes and enhancements to our JavaScript in v5 that focus on code quality and bridging the gap between v4 and v5. One of our other larger changes was dropping the bulk of our Button plugin for an HTML and CSS only approach to toggle states. Now toggle buttons are powered by checkboxes and radio buttons and are much more reliable.&#x3C;/p&#x3E;&#x3C;p&#x3E;You can see the full list of JS related changes in the first v5 alpha project on GitHub.&#x3C;/p&#x3E;&#x3C;p&#x3E;Interested in helping out on Bootstrap&#x2019;s JavaScript? We&#x2019;re always looking for new contributors to the team to help write new plugins, review pull requests, and fix bugs. Let us know!&#x3C;/p&#x3E;&#x3C;h3&#x3E;CSS custom properties&#x3C;/h3&#x3E;&#x3C;p&#x3E;As mentioned, we&#x2019;ve begun using CSS custom properties in Bootstrap 5 thanks to dropping support for Internet Explorer. In v4 we only included a handful of root variables for color and fonts, and now we&#x2019;ve added them for a handful of components and layout options.&#x3C;/p&#x3E;&#x3C;p&#x3E;Take for example our .table component, where we&#x2019;ve added a handful of local variables to make striped, hoverable, and active table styles easier:&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-css&#x22;&#x3E;&#x3C;code class=&#x22;language-css&#x22;&#x3E;.table {
  --bs-table-bg: #{&#36;table-bg};
  --bs-table-accent-bg: transparent;
  --bs-table-striped-color: #{&#36;table-striped-color};
  --bs-table-striped-bg: #{&#36;table-striped-bg};
  --bs-table-active-color: #{&#36;table-active-color};
  --bs-table-active-bg: #{&#36;table-active-bg};
  --bs-table-hover-color: #{&#36;table-hover-color};
  --bs-table-hover-bg: #{&#36;table-hover-bg};

  // Styles here...
}&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;We&#x2019;re working to utilize the superpowers of both Sass and CSS custom properties for a more flexible system. You can read more about this in the Tables docs page and expect to see more usage in components like buttons in the near future.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Improved customizing docs&#x3C;/h3&#x3E;&#x3C;p&#x3E;We&#x2019;ve hunkered down and improved our documentation in several places, giving more explanation, removing ambiguity, and providing much more support for extending Bootstrap. It all starts with a whole new Customize section.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://user-images.githubusercontent.com/98681/84740682-ac43c600-af62-11ea-88a4-79c1362061c8.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;v5&#x2019;s Customize docs expand on v4&#x2019;s Theming page with more content and code snippets for building on top of Bootstrap&#x2019;s source Sass files. We&#x2019;ve fleshed out more content here and even provided a starter npm project for you to get started with faster and easier. It&#x2019;s also available as a template repo on GitHub, so you can freely fork and go.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://user-images.githubusercontent.com/98681/84801339-e5585680-afb3-11ea-8743-29647ff3f3a9.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;We&#x2019;ve expanded our color palette in v5, too. With an extensive color system built-in, you can more easily customize the look and feel of your app without ever leaving the codebase. We&#x2019;ve also done some work to improve color contrast, and even provided color contrast metrics in our Color docs. Hopefully, this will continue to help make Bootstrap-powered sites more accessible to folks all over.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Updated forms&#x3C;/h3&#x3E;&#x3C;p&#x3E;In addition to the new Customize section, we&#x2019;ve overhauled our Forms documentation and components. We&#x2019;ve consolidated all our forms styles into a new Forms section (including the input group component) to give them the emphasis they deserve.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-forms.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;Alongside new docs pages, we&#x2019;ve redesigned and de-duped all our form controls. In v4 we introduced an extensive suite of custom form controls&#x2014;checks, radios, switches, files, and more&#x2014;but those were in addition to whatever defaults each browser provided. With v5, we&#x2019;ve gone fully custom.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-checks.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;If you&#x2019;re familiar with v4&#x2019;s form markup, this shouldn&#x2019;t look too far off for you. With a single set of form controls and a focus on redesigning existing elements vs generating new ones via pseudo-elements, we have a much more consistent look and feel.&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-html&#x22;&#x3E;&#x3C;code class=&#x22;language-html&#x22;&#x3E;&#x26;lt;div class=&#x22;form-check&#x22;&#x26;gt;
  &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;checkbox&#x22; value=&#x22;&#x22; id=&#x22;flexCheckDefault&#x22;&#x26;gt;
  &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexCheckDefault&#x22;&#x26;gt;
    Default checkbox
  &#x26;lt;/label&#x26;gt;
&#x26;lt;/div&#x26;gt;

&#x26;lt;div class=&#x22;form-check&#x22;&#x26;gt;
  &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;radio&#x22; name=&#x22;flexRadioDefault&#x22; id=&#x22;flexRadioDefault1&#x22;&#x26;gt;
  &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexRadioDefault1&#x22;&#x26;gt;
    Default radio
  &#x26;lt;/label&#x26;gt;
&#x26;lt;/div&#x26;gt;

&#x26;lt;div class=&#x22;form-check form-switch&#x22;&#x26;gt;
  &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;checkbox&#x22; id=&#x22;flexSwitchCheckDefault&#x22;&#x26;gt;
  &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexSwitchCheckDefault&#x22;&#x26;gt;Default switch checkbox input&#x26;lt;/label&#x26;gt;
&#x26;lt;/div&#x26;gt;&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Every checkbox, radio, select, file, range, and more
includes a custom appearance to unify the style and behavior of form controls across OS and browser. These new form
controls are all built on completely semantic, standard form controls&#x2014;no more superfluous markup, just form
controls and labels.&#x3C;/p&#x3E;&#x3C;p&#x3E;Be sure to explore the new forms docs and let us know what you
think.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Utilities API&#x3C;/h3&#x3E;&#x3C;p&#x3E;We love seeing how many folks are building
new and interesting CSS libraries and toolkits, challenging the way we&#x2019;ve built on the web for the last
decade-plus. It&#x2019;s refreshing, to say the least, and affords us all an opportunity to discuss and iterate. As
such, we&#x2019;ve implemented a brand new utility API into Bootstrap 5.&#x3C;/p&#x3E;&#x3C;pre
class=&#x22;language-sas&#x22;&#x3E;&#x3C;code class=&#x22;language-sas&#x22;&#x3E;&#36;utilities: () !default;
&#36;utilities: map-merge(
  (
    // ...
    &#x22;width&#x22;: (
      property: width,
      class: w,
      values: (
        25: 25%,
        50: 50%,
        75: 75%,
        100: 100%,
        auto: auto
      )
    ),
    // ...
    &#x22;margin&#x22;: (
      responsive: true,
      property: margin,
      class: m,
      values: map-merge(&#36;spacers, (auto: auto))
    ),
    // ...
  ), &#36;utilities);&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Ever since utilities become a preferred way to build,
  we&#x2019;ve been working to find the right balance to implement them in Bootstrap while providing control and
  customization. In v4, we did this with global &#36;enable-* classes, and we&#x2019;ve even carried that forward in v5.
  But
  with an API based approach, we&#x2019;ve created a language and syntax in Sass to create your own utilities on the fly
  while also being able to modify or remove those we provide. This is all thanks to @MartijnCuppens, who also maintains
  the RFS project, and is responsible for the initial PR and subsequent improvements.&#x3C;/p&#x3E;&#x3C;p&#x3E;We think
  this will be a game-changer for those who build on Bootstrap via our source files, and if you haven&#x2019;t built a
  Bootstrap-powered project that way yet, your mind will be blown.&#x3C;/p&#x3E;&#x3C;p&#x3E;Heads up! We&#x2019;ve
  moved some of our former v4 utilities to a new Helpers section. These helpers are snippets of code that are longer
  than your usual property-value pairing for our utilities. Just our way of reorganizing things for easier naming and
  improved documentation.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Enhanced grid system&#x3C;/h3&#x3E;&#x3C;p&#x3E;By design Bootstrap
  5 isn&#x2019;t a complete departure from v4. We wanted everyone to be able to more easily upgrade to this future
  version after hearing about the difficulties from the v3 to v4 upgrade path. We&#x2019;ve kept the bulk of the build
  system in place (minus jQuery) for this reason, and we&#x2019;ve also built on the existing grid system instead of
  replacing it with something newer and hipper.&#x3C;/p&#x3E;&#x3C;p&#x3E;Here&#x2019;s a rundown of what&#x2019;s
  changed in our grid:&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;We&#x2019;ve added a new grid tier! Say hello to
  xxl.&#x3C;/li&#x3E;&#x3C;li&#x3E;.gutter classes have been replaced with .g* utilities, much like our margin/padding
  utilities. We&#x2019;ve also added options to your grid gutter spacing that matches the spacing utilities
  you&#x2019;re already familiar with.&#x3C;/li&#x3E;&#x3C;li&#x3E;Form layout options have been replaced with the new
  grid system.&#x3C;/li&#x3E;&#x3C;li&#x3E;Vertical spacing classes have been added.&#x3C;/li&#x3E;&#x3C;li&#x3E;Columns
  are no longer position: relative by default.&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;Here&#x2019;s a quick example
  of how to use the new grid gutter classes:&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-html&#x22;&#x3E;&#x3C;code
  class=&#x22;language-html&#x22;&#x3E;&#x26;lt;div class=&#x22;row g-5&#x22;&#x26;gt;
  &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
  &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
  &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
&#x26;lt;/div&#x26;gt;&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Take a look at the redesigned and restructured Layout docs to learn more.&#x3C;/p&#x3E;&#x3C;p&#x3E;CSS&#x2019;s grid layout is increasingly ready for prime time, and while we haven&#x2019;t made use of it here yet, we&#x2019;re continuing to experiment and learn from it. Look to future releases of v5 to embrace it in more ways.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Docs&#x3C;/h3&#x3E;&#x3C;p&#x3E;We switched our documentation static site generator from Jekyll to Hugo. Jekyll has long been our generator of choice given how easy it is to get up and running, and its simplicity with deploying to GitHub Pages.&#x3C;/p&#x3E;&#x3C;p&#x3E;Unfortunately, we&#x2019;ve reached two major issues with Jekyll over the years:&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;Jekyll requires Ruby to be installed&#x3C;/li&#x3E;&#x3C;li&#x3E;Site generation was very slow&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;Hugo on the other hand is written in Go, so it has no external runtime dependencies, and it&#x2019;s much faster. We build our current master branch site, including the doc&#x2019;s Sass -&#x26;gt; CSS in ~1.6s. Our local server reloads in milliseconds instead of 8-12 seconds, so working on the docs has become a pleasant experience again.&#x3C;/p&#x3E;&#x3C;p&#x3E;The Hugo switch wouldn&#x2019;t have been possible without Hugo&#x2019;s main developer work, Bj&#xF8;rn Erik Pedersen (@bep), who made quite a few codebase changes to make the transition possible and smooth!&#x3C;/p&#x3E;&#x3C;p&#x3E;Also a shoutout to @xhmikosr who led the charge here in converting hundreds of files and working with the Hugo developers to make sure our local development was fast, efficient, and maintainable.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Coming soon: RTL, offcanvas, and more&#x3C;/h3&#x3E;&#x3C;p&#x3E;There&#x2019;s a ton we just didn&#x2019;t have time to tackle in our first alpha that&#x2019;s still on the todo list for future alphas. We wanted to give them some love here so you know what&#x2019;s on our radar throughout v5&#x2019;s development.&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;RTL is coming! We&#x2019;ve spiked out a PR using RTLCSS and are continuing to explore logical properties as well. Personally, I&#x2019;m sorry for taking so long for us to officially tackle this knowing all the effort that&#x2019;s gone into it community efforts and pull requests to the project. Hopefully, the wait is worth it.&#x3C;/li&#x3E;&#x3C;li&#x3E;There&#x2019;s a forked version of our modal that&#x2019;s implementing an offcanvas menu. We still have some work to do here to get this right without adding too much overhead, but the idea of having an offcanvas wrapper to place any sidebar-worth content&#x2014;navigation, shopping cart, etc&#x2014;is huge. Personally, I know we&#x2019;re behind the times on this one, but it should be awesome nonetheless.&#x3C;/li&#x3E;&#x3C;li&#x3E;We&#x2019;re evaluating a number of other changes to our codebase, including the Sass module system, increased usage of CSS custom properties, embedding SVGs in our HTML instead of our CSS, and more.&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;There&#x2019;s a ton yet to come, including more documentation improvements, bug fixes, and quality of life changes. Be sure to review our open issues and PRs to see where you can help out by providing feedback, testing community PRs, or sharing your ideas.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Get started&#x3C;/h3&#x3E;&#x3C;p&#x3E;Head to https://v5.getbootstrap.com to explore the new release. We&#x2019;ve also published this updated as a pre-release to npm, so if you&#x2019;re feeling bold or are curious about what&#x2019;s new, you can pull the latest in that way.&#x3C;/p&#x3E;&#x3C;p&#x3E;npm i bootstrap@next&#x3C;/p&#x3E;&#x3C;h3&#x3E;What&#x2019;s next&#x3C;/h3&#x3E;&#x3C;p&#x3E;We still have more work to do in v5, including some breaking changes, but we&#x2019;re incredibly excited about this release. Let the feedback rip and we&#x2019;ll do our best to keep up with y&#x2019;all. Our goal is to ship another alpha within 3-4 weeks, and likely a couple more after that. We&#x2019;ll also be shipping a v4.5.1 release to fix a couple of regressions and continue to bridge the gap between v4 and v5.&#x3C;/p&#x3E;&#x3C;p&#x3E;Beyond that, keep an eye for more updates to the Bootstrap Icons project, our RFS project (now enabled by default in v5), and the npm starter project.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Support the team&#x3C;/h3&#x3E;&#x3C;p&#x3E;Visit our Open Collective page or our team members&#x2019; GitHub profiles to help support the maintainers contributing to Bootstrap.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x26;lt;3,&#x3C;/p&#x3E;&#x3C;p&#x3E;@mdo &#x26;amp; team&#x3C;/p&#x3E;"),
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "post",
            "post_image" => "v5-new-logo-juUpLoxSMz.png",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => "2020-06-20 00:00:13",
            "updated_at" => "2020-06-20 00:00:13"
        ]);
        $post = App\Models\Post::find($newpost->id)->termtaxonomy()->sync([3,24,25,26,27]);

        #Sampe Page 1

        App\Models\Post::create([
            "post_title" => "About",
            "post_name" => "about",
            "post_summary" => "<p>Lorem Ipsum Dolor Sit Amet</p>",
            "post_content" => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis numquam at, fugit commodi, placeat similique ex officia reiciendis soluta, deserunt autem cupiditate labore rem minima delectus quibusdam illum et? Hic?</p>",
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "page",
            "post_status" => "publish",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        ## Sample Gallery

        App\Models\Post::create([
            "post_title" => "Picone",
            "post_name" => "picone",
            "post_summary" => '<p>Wallpaper</p>',
            "post_content" => '<p>Image description</p>',
            "post_hits" => 0,
            "post_author" => 2,
            "post_type" => "gallery",
            "post_guid" => "/storage/images/picone.jpg",
            "post_image_meta" => "{\"file\":\"picone.jpg\",\"type\":\"jpeg\",\"size\":614182,\"dimension\":\"1920x1080\",\"attr_image_alt\":\"another text\"}",
            "post_mime_type" => "image/jpeg",
            "post_status" => "inherit",
            "comment_status" => "open",
            "comment_count" => 0,
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);


    }
}
