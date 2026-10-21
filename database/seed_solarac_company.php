<?php
/**
 * SOLARAC Company LTD - Database Seeder
 * Populates solaraccompany_db with 100% authentic corporate content & assets
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

try {
    $pdo = Database::getConnection();
    echo "Connected to database successfully: " . env('DB_NAME') . "\n";

    $pdo->beginTransaction();

    // 1. UPDATE SITE SETTINGS
    $settings = [
        'company_name'           => 'SOLARAC Company LTD',
        'tagline'                => 'CIVIL ENGINEERING, BUILDING CONSTRUCTION & PROJECT MANAGEMENT',
        'motto'                  => 'Building the Future with Integrity, Innovation and Excellence.',
        'rc_number'              => 'RC: 1175907',
        'cac_number'             => 'RC 1175907',
        'logo_url'               => 'assets/images/logo.png',
        'favicon_url'            => 'assets/images/logo.png',
        'phone_primary'          => '08035188495',
        'phone_secondary'        => '08065833345',
        'email_primary'          => 'info@solaraccompany.com',
        'email_support'          => 'info@solaraccompany.com',
        'office_address'         => 'No 48, Baruwa Street, Opposite Old Governor\'s Office, Osogbo, Osun State, Nigeria',
        'city'                   => 'Osogbo',
        'state'                  => 'Osun State',
        'country'                => 'Nigeria',
        'business_hours'         => 'Mon - Fri: 8:00 AM - 6:00 PM | Sat: 9:00 AM - 4:00 PM | Sun: Closed',
        'whatsapp_number'        => '2348035188495',
        'whatsapp_message'       => 'Hello SOLARAC Company LTD, I would like to inquire about your civil engineering, construction, and project management services.',
        'whatsapp_enabled'       => '1',
        'hero_headline'          => 'Building the Future with Integrity, Innovation & Engineering Excellence',
        'hero_subheadline'       => 'SOLARAC Company LTD (RC: 1175907) is a premier Nigerian civil and building construction firm delivering expertise in Project Management, Structural Design, General Facilities Management, and Turnkey EPC Contracting.',
        'hero_cta_primary_text'  => 'REQUEST A QUOTE',
        'hero_cta_primary_link'  => 'quote.php',
        'hero_cta_secondary_text'=> 'EXPLORE OUR SERVICES',
        'hero_cta_secondary_link'=> 'services.php',
        'about_overview'         => 'SOLARAC Company Limited (RC: 1175907) is an indigenous Limited Liability Company incorporated to deliver exceptional expertise in Project Management, Civil Engineering and Construction, General Facilities Management, and General Contract Services. Headquartered in Osogbo, Osun State, we have built a reputation for delivering high-impact projects that meet the most stringent international standards.',
        'mission'                => 'At SOLARAC, our mission is to build the Future with Integrity, Innovation and Excellence. We are dedicated to delivering High-Quality Construction Solutions that not only meet but exceed our Clients\' expectations by fostering a culture of safety, sustainability, and collaboration to create long-lasting structures that enhance the communities we serve.',
        'vision'                 => 'Our vision is to be a Trusted Leader in the Construction and Real Estate Industry, delivering Exceptional Quality, Innovative Solutions, and Lasting Values for our Clients and Communities across Nigeria and beyond.',
        'why_choose_us'          => 'Proven engineering track record, COREN/NSE certified personnel, state-of-the-art construction equipment, uncompromising safety compliance, and on-time project completion within budget.',
        'google_maps_embed'      => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.889379848555!2d4.5501869!3d7.7788481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1037882200000001%3A0x64b8bb26d9c6e545!2sOsogbo%2C%20Osun!5e0!3m2!1sen!2sng!4v1700000000000!5m2!1sen!2sng" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        'smtp_from_email'        => 'info@solaraccompany.com',
        'smtp_from_name'         => 'SOLARAC Company LTD',
        'section_hero_enabled'   => '1',
        'section_services_enabled' => '1',
        'section_why_choose_enabled' => '1',
        'section_products_enabled' => '0',
        'section_projects_enabled' => '1',
        'section_quote_cta_enabled' => '1',
        'section_testimonials_enabled' => '1'
    ];

    $stmtSet = $pdo->prepare("INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_group`, `label`, `field_type`) 
                              VALUES (?, ?, 'general', ?, 'text') 
                              ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`)");
    foreach ($settings as $k => $v) {
        $label = ucwords(str_replace('_', ' ', $k));
        $stmtSet->execute([$k, $v, $label]);
    }
    echo "Site settings updated.\n";

    // 2. SERVICE CATEGORIES
    $pdo->exec("DELETE FROM `services`");
    $pdo->exec("DELETE FROM `service_categories`");
    
    $secCats = [
        ['name' => 'Project Management & EPC', 'slug' => 'project-management', 'description' => 'Complete lifecycle engineering supervision, cost engineering, procurement, and turnkey delivery.'],
        ['name' => 'Civil & Building Construction', 'slug' => 'civil-construction', 'description' => 'Structural engineering, multi-story buildings, raft foundations, and educational institutions.'],
        ['name' => 'Infrastructure & Transportation', 'slug' => 'infrastructure-transport', 'description' => 'Road construction, reinforced concrete fences, bridges, drainage, and hydraulic structures.'],
        ['name' => 'Facilities Management & Telecom', 'slug' => 'facilities-telecom', 'description' => 'Telecom mast erection, base stations, mechanical maintenance, and corporate facility management.']
    ];
    $stmtCat = $pdo->prepare("INSERT INTO `service_categories` (`name`, `slug`, `description`) VALUES (?, ?, ?)");
    $catMap = [];
    foreach ($secCats as $sc) {
        $stmtCat->execute([$sc['name'], $sc['slug'], $sc['description']]);
        $catMap[$sc['slug']] = (int)$pdo->lastInsertId();
    }
    echo "Service categories seeded.\n";

    // 3. SERVICES
    $servicesList = [
        [
            'category_id' => $catMap['project-management'],
            'title' => 'Comprehensive Project Management',
            'slug' => 'project-management-services',
            'short_description' => 'End-to-end engineering supervision, quality control, cost management, and timely project delivery from planning to completion.',
            'full_description' => 'SOLARAC provides full-lifecycle construction project management designed to eliminate risks, minimize overheads, and guarantee architectural excellence. Our experienced project managers supervise daily site operations, maintain stringent QA/QC schedules, oversee vendor compliance, and ensure zero-compromise safety protocols under Advanced HSE frameworks.',
            'features' => json_encode(['Feasibility & Site Assessment', 'CPM Scheduling & Milestones', 'Procurement & Vendor Oversight', 'Advanced QA/QC Testing', 'Full Regulatory Handover & Commissioning']),
            'image' => 'assets/images/slide1.jpg',
            'icon' => 'briefcase',
            'sort_order' => 1
        ],
        [
            'category_id' => $catMap['civil-construction'],
            'title' => 'Civil Engineering & Building Construction',
            'slug' => 'civil-engineering-construction',
            'short_description' => 'Execution of modern commercial complexes, educational institutions, residential blocks, and industrial superstructures.',
            'full_description' => 'We engineer and construct landmark structures utilizing state-of-the-art Eurocode, BS, and Nigerian building code standards. Notable deliveries include the Ataoja Model School of Science in Osogbo, high-density residential blocks in Lagos, and specialized foundation works across South-West Nigeria.',
            'features' => json_encode(['Reinforced Concrete Works', 'Commercial & Institutional Complexes', 'High-Rise & Block of Flats', 'Structural Steel Fabrication', 'Architectural Design-Build Execution']),
            'image' => 'assets/images/projects/completed ataoja.jpeg',
            'icon' => 'building',
            'sort_order' => 2
        ],
        [
            'category_id' => $catMap['civil-construction'],
            'title' => 'Foundation Engineering & Sub-Structures',
            'slug' => 'foundation-engineering',
            'short_description' => 'High-capacity raft foundations, pile caps, soil stabilization, and heavy load-bearing substructures.',
            'full_description' => 'Our structural engineers specialize in deep foundation solutions and raft foundations for challenging terrains, including waterlogged coastal areas like Lekki Scheme 2 in Lagos where we engineered 40 units of Raft Foundations for 3-story blocks of flats.',
            'features' => json_encode(['Raft Foundation Engineering', 'Heavy Reinforced Sub-bases', 'Geotechnical Soil Analysis', 'Waterproofing & Damp-proofing', 'Structural Load Testing']),
            'image' => 'assets/images/projects/foundation work (1).jpeg',
            'icon' => 'layers',
            'sort_order' => 3
        ],
        [
            'category_id' => $catMap['infrastructure-transport'],
            'title' => 'Reinforced Concrete Fencing & Civil Works',
            'slug' => 'reinforced-concrete-fencing',
            'short_description' => 'Industrial perimeter security walls, fair-faced concrete barriers, and massive civil infrastructure.',
            'full_description' => 'Specialized construction of high-durability reinforced concrete perimeter walls for free trade zones, government assets, and industrial parks. Featured project: 300m Reinforced Concrete Fence for Livingspring Free Trade Zone, Abeere-Ede Road, Osogbo.',
            'features' => json_encode(['300m+ Industrial Concrete Fences', 'Fair-Faced Architectural Concrete', 'Perimeter Security Structures', 'Earth Retention & Retaining Walls', 'Heavy Earthmoving & Grading']),
            'image' => 'assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg',
            'icon' => 'shield',
            'sort_order' => 4
        ],
        [
            'category_id' => $catMap['infrastructure-transport'],
            'title' => 'Transportation & Hydraulic Engineering',
            'slug' => 'transportation-hydraulic-engineering',
            'short_description' => 'Road network construction, asphalt surfacing, bridge culverts, drainage channels, and water infrastructure.',
            'full_description' => 'Planning, engineering, and construction of vital transport links that connect communities and promote economic vitality. We construct durable roads, access corridors, hydraulic retaining walls, and storm-water drainage networks with maximum lifespan.',
            'features' => json_encode(['Road Infrastructure & Asphalting', 'Box Culverts & Hydraulic Channels', 'Storm Drainage Systems', 'Traffic Flow Planning', 'Bridge Abutments & Retaining Structures']),
            'image' => 'assets/images/slide3.jpg',
            'icon' => 'truck',
            'sort_order' => 5
        ],
        [
            'category_id' => $catMap['facilities-telecom'],
            'title' => 'General Facilities Management & Telecom Infrastructure',
            'slug' => 'facilities-management-telecom',
            'short_description' => 'Telecom mast erection, base transceiver station (BTS) construction, corporate building maintenance, and MEP services.',
            'full_description' => 'Turnkey facilities management and telecommunication engineering services. Our teams manage high-grade telecom masts, BTS infrastructure, mechanical, electrical, plumbing (MEP) installations, and routine facility refurbishment to protect asset value.',
            'features' => json_encode(['Telecom Mast Erection & Maintenance', 'BTS Foundation & Tower Grounding', 'Corporate Facility Maintenance', 'MEP Infrastructure Servicing', 'Painting, Decorating & Protective Coatings']),
            'image' => 'assets/images/slide2.jpg',
            'icon' => 'tool',
            'sort_order' => 6
        ]
    ];

    $stmtSrv = $pdo->prepare("INSERT INTO `services` (`category_id`, `title`, `slug`, `short_description`, `full_description`, `features`, `image`, `icon`, `sort_order`, `status`) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')");
    foreach ($servicesList as $srv) {
        $stmtSrv->execute([
            $srv['category_id'],
            $srv['title'],
            $srv['slug'],
            $srv['short_description'],
            $srv['full_description'],
            $srv['features'],
            $srv['image'],
            $srv['icon'],
            $srv['sort_order']
        ]);
    }
    echo "Services seeded.\n";

    // 4. PROJECT CATEGORIES
    $pdo->exec("DELETE FROM `project_images`");
    $pdo->exec("DELETE FROM `projects`");
    $pdo->exec("DELETE FROM `project_categories`");

    $projCats = [
        ['name' => 'Educational & Institutional', 'slug' => 'educational-institutional'],
        ['name' => 'Infrastructure & Industrial Fencing', 'slug' => 'infrastructure-fencing'],
        ['name' => 'Residential & Housing Estates', 'slug' => 'residential-housing'],
        ['name' => 'Foundations & Earthworks', 'slug' => 'foundations-earthworks'],
        ['name' => 'Commercial & Community Centers', 'slug' => 'commercial-community']
    ];
    $stmtPCat = $pdo->prepare("INSERT INTO `project_categories` (`name`, `slug`, `description`) VALUES (?, ?, ?)");
    $pCatMap = [];
    foreach ($projCats as $pc) {
        $stmtPCat->execute([$pc['name'], $pc['slug'], $pc['name'] . ' Projects']);
        $pCatMap[$pc['slug']] = (int)$pdo->lastInsertId();
    }
    echo "Project categories seeded.\n";

    // 5. PROJECTS
    $projectsList = [
        [
            'category_id' => $pCatMap['educational-institutional'],
            'title' => 'Ataoja Model School of Science',
            'slug' => 'ataoja-model-school-of-science',
            'client' => 'Osun State Government / Ministry of Works',
            'location' => 'Osogbo, Osun State',
            'description' => 'Engineering supervision and turnkey construction of Ataoja Model School of Science in Osogbo, recognized as a landmark academic institution in Osun State.',
            'scope' => 'Complete engineering supervision and construction of modern science lecture halls, laboratories, administrative facilities, external paved accesses, and storm water drainage.',
            'featured_image' => 'assets/images/projects/completed ataoja.jpeg',
            'completion_date' => '2023-11-15',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['infrastructure-fencing'],
            'title' => 'Livingspring Free Trade Zone 300m Reinforced Concrete Fence',
            'slug' => 'livingspring-free-trade-zone-fence',
            'client' => 'Livingspring Free Trade Zone Authority',
            'location' => 'Abeere-Ede Road, Osun State',
            'description' => 'Construction of 300m fair-faced reinforced concrete security perimeter fence for Livingspring Free Trade Zone, delivering maximum durability and structural resilience.',
            'scope' => '300 meters of continuous high-strength reinforced concrete fence panels, heavy pilasters, grade beams, expansion joints, and erosion control retaining walls.',
            'featured_image' => 'assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg',
            'completion_date' => '2024-02-20',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['foundations-earthworks'],
            'title' => '40 Units Raft Foundation for 3-Story Blocks of Flats',
            'slug' => 'raft-foundation-lekki-scheme-2',
            'client' => 'Prime Residential Consortium',
            'location' => 'Lekki Scheme 2, Lagos State',
            'description' => 'Engineering and casting of 40 units of high-capacity Raft Foundations for 3-story block of flats at Lekki Scheme 2, Lagos, ensuring zero-settlement stability in coastal terrain.',
            'scope' => 'Excavation, geotechnical stabilization, continuous steel reinforcement grids, damp-proof membrane installation, and precision high-MPa concrete casting.',
            'featured_image' => 'assets/images/projects/foundation work (1).jpeg',
            'completion_date' => '2024-06-10',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['commercial-community'],
            'title' => 'Jokodolu Foundation Vocational Center & Admin Complex',
            'slug' => 'jokodolu-foundation-vocational-complex',
            'client' => 'Jokodolu Foundation',
            'location' => 'Ogbomoso, Oyo State',
            'description' => 'Construction of 200-Seater Vocational Training Hall, Administrative Complex, and Computer Laboratory for the Jokodolu Foundation in Ogbomoso.',
            'scope' => 'Structural concrete framing, high-span roofing, specialized computer lab power architecture, seminar halls, and surrounding paved compound.',
            'featured_image' => 'assets/images/projects/jk (1).jpeg',
            'completion_date' => '2024-04-18',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['infrastructure-fencing'],
            'title' => 'Reinforced Concrete Perimeter Barrier - Obada-Ede',
            'slug' => 'reinforced-concrete-fence-obada-ede',
            'client' => 'Industrial Estate Developers',
            'location' => 'Obada-Ede, Osun State',
            'description' => 'Reinforced concrete security fence constructed with heavy structural columns and anti-weathering concrete in Obada-Ede.',
            'scope' => 'Structural excavation, concrete columns casting, pre-cast and in-situ wall panels, capping beams, and anti-intrusion perimeter design.',
            'featured_image' => 'assets/images/projects/reinforeced concrete fece obada-ede.jpeg',
            'completion_date' => '2023-09-30',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['educational-institutional'],
            'title' => 'Ataoja Model School Construction - Phase 2',
            'slug' => 'ataoja-construction-phase-2',
            'client' => 'Osun State Ministry of Works',
            'location' => 'Osogbo, Osun State',
            'description' => 'Phase 2 expansion of Ataoja Model School of Science, completing advanced laboratories and campus access infrastructure.',
            'scope' => 'Superstructure construction, internal partitions, architectural painting and coating, plumbing installations, and electrical distribution.',
            'featured_image' => 'assets/images/projects/ata2.jpeg',
            'completion_date' => '2024-01-15',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['foundations-earthworks'],
            'title' => 'Structural Foundation Works - Phase 2',
            'slug' => 'foundation-construction-phase-2',
            'client' => 'Commercial Developers Ltd',
            'location' => 'Lekki Coastal Corridor, Lagos',
            'description' => 'Deep foundation works executing precision reinforced concrete substructures under challenging soil conditions.',
            'scope' => 'Deep beam excavations, steel cage placement, concrete vibratory compaction, and moisture barrier integration for high-density foundations.',
            'featured_image' => 'assets/images/projects/foundation work (2).jpeg',
            'completion_date' => '2024-08-01',
            'status' => 'ongoing',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['residential-housing'],
            'title' => 'Modern Multi-Unit Residential Block Development',
            'slug' => 'modern-multi-unit-residential-development',
            'client' => 'Private Property Investors',
            'location' => 'Osogbo Metro, Osun State',
            'description' => 'Turnkey construction of modern residential units with reinforced concrete slab framing and luxury surface finishes.',
            'scope' => 'Full architectural execution from ground-breaking to luxury interior finishing, protective coating, and exterior landscaping.',
            'featured_image' => 'assets/images/projects/image-4.jpg',
            'completion_date' => '2024-05-20',
            'status' => 'completed',
            'published_status' => 'published'
        ],
        [
            'category_id' => $pCatMap['commercial-community'],
            'title' => 'Jokodolu Foundation Service Quarters Complex',
            'slug' => 'jokodolu-foundation-service-quarters',
            'client' => 'Jokodolu Foundation',
            'location' => 'Ogbomoso, Oyo State',
            'description' => 'Dedicated service quarters constructed within the Jokodolu Foundation training compound in Ogbomoso.',
            'scope' => 'Construction of modern residential quarters for administrative staff and trainers, complete with utilities and security features.',
            'featured_image' => 'assets/images/projects/jk (2).jpeg',
            'completion_date' => '2024-07-15',
            'status' => 'completed',
            'published_status' => 'published'
        ]
    ];

    $stmtProj = $pdo->prepare("INSERT INTO `projects` (`category_id`, `title`, `slug`, `location`, `client`, `description`, `scope`, `completion_date`, `status`, `featured_image`, `published_status`) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($projectsList as $p) {
        $stmtProj->execute([
            $p['category_id'],
            $p['title'],
            $p['slug'],
            $p['location'],
            $p['client'],
            $p['description'],
            $p['scope'],
            $p['completion_date'],
            $p['status'],
            $p['featured_image'],
            $p['published_status']
        ]);
        $projId = (int)$pdo->lastInsertId();

        // Add gallery image
        $stmtPImg = $pdo->prepare("INSERT INTO `project_images` (`project_id`, `image_path`, `caption`, `sort_order`) VALUES (?, ?, ?, 1)");
        $stmtPImg->execute([$projId, $p['featured_image'], $p['title']]);
    }
    echo "Projects seeded.\n";

    // 6. TEAM MEMBERS
    $pdo->exec("DELETE FROM `team_members`");
    $team = [
        [
            'name' => 'Engr. Bashiru Abiola Saliu',
            'position' => 'Managing Partner & Seasoned Civil Engineer (MNSE, FNICE)',
            'bio' => 'Engr. Bashiru Abiola Saliu MNSE, FNICE brings nearly 20 years of sterling experience in civil engineering, structural design, project management, financial management, and human resource leadership. He has spearheaded road, bridge, telecom mast, hydraulic, and building projects across Nigeria. Advanced HSE and EIA Certified.',
            'image' => 'assets/images/certificates/unnamed (2).png',
            'sort_order' => 1
        ],
        [
            'name' => 'Engr. Odebunmi Babawale',
            'position' => 'Managing Director (B.Tech Structural Eng, M.Eng Construction Mgt)',
            'bio' => 'Engr. Babawale oversees corporate strategy, technical leadership, and engineering innovation. He directs technical teams on structural analysis, Eurocode compliance, and high-impact infrastructure delivery.',
            'image' => 'assets/images/certificates/page24_img2.png',
            'sort_order' => 2
        ],
        [
            'name' => 'Engr. Salam B.H',
            'position' => 'Senior Project Manager (B.Tech Civil Eng, PMP)',
            'bio' => 'Engr. Salam coordinates complex civil construction operations from planning to client handover. His rigorous project governance and quality control ensure timely delivery and client satisfaction.',
            'image' => 'assets/images/certificates/page25_img2.png',
            'sort_order' => 3
        ],
        [
            'name' => 'Engr. Ogunsadekoya Samuel',
            'position' => 'Project Lead & Safety Officer (B.Tech Civil Eng, Certified Safety)',
            'bio' => 'Engr. Samuel oversees on-site civil operations, technical supervision, and strict adherence to occupational safety protocols, ensuring zero-incident project execution across all job sites.',
            'image' => 'assets/images/certificates/page26_img2.png',
            'sort_order' => 4
        ],
        [
            'name' => 'Ajibade Taofeek Oladayo',
            'position' => 'Certified Painting & Decorating Specialist (Fed Ministry of Labour)',
            'bio' => 'Ajibade is a skilled painting and protective coating specialist with meticulous attention to detail, delivering durable, elegant surface finishes for commercial, institutional, and luxury residential projects.',
            'image' => 'assets/images/certificates/TAOFEEK-CERT.png',
            'sort_order' => 5
        ],
        [
            'name' => 'Afolabi Titilope Busayo',
            'position' => 'Certified Carpenter & Joiner Specialist (Fed Ministry of Labour & FSTC Yaba)',
            'bio' => 'Afolabi is a certified carpentry and joinery craftsman with extensive technical expertise in structural timber formwork, precision architectural joinery, reinforced concrete shuttering, and bespoke roof truss systems for civil engineering and modern building projects.',
            'image' => 'assets/images/certificates/AFOLABI-LABOUR-CERT.png',
            'sort_order' => 6
        ]
    ];

    $stmtTeam = $pdo->prepare("INSERT INTO `team_members` (`name`, `position`, `bio`, `image`, `sort_order`, `status`) VALUES (?, ?, ?, ?, ?, 'active')");
    foreach ($team as $t) {
        $stmtTeam->execute([$t['name'], $t['position'], $t['bio'], $t['image'], $t['sort_order']]);
    }
    echo "Team members seeded.\n";

    // 7. TESTIMONIALS
    $pdo->exec("DELETE FROM `testimonials`");
    $testimonials = [
        [
            'client_name' => 'Alhaji K. Adediran',
            'organization' => 'Ataoja Model School Development Board, Osogbo',
            'content' => 'SOLARAC Company LTD demonstrated unmatched engineering precision during the construction of Ataoja Model School of Science. Their attention to structural integrity, timely milestone delivery, and quality materials made them our best construction partner to date.',
            'rating' => 5,
            'sort_order' => 1
        ],
        [
            'client_name' => 'Engr. D. Ogunleye',
            'organization' => 'Livingspring Free Trade Zone Authority',
            'content' => 'The 300m reinforced concrete fence delivered by SOLARAC at the Free Trade Zone stands as proof of superior craftsmanship. Their fair-faced concrete finishing and adherence to strict project timelines exceeded our expectations.',
            'rating' => 5,
            'sort_order' => 2
        ],
        [
            'client_name' => 'Chief M. O. Jokodolu',
            'organization' => 'Chairman, Board of Trustees, Jokodolu Foundation',
            'content' => 'The vocational training complex and administrative buildings constructed by SOLARAC in Ogbomoso are truly state-of-the-art. Their leadership team was accessible, professional, and transparent from day one.',
            'rating' => 5,
            'sort_order' => 3
        ]
    ];
    $stmtTest = $pdo->prepare("INSERT INTO `testimonials` (`client_name`, `organization`, `content`, `rating`, `status`, `sort_order`) VALUES (?, ?, ?, ?, 'published', ?)");
    foreach ($testimonials as $test) {
        $stmtTest->execute([$test['client_name'], $test['organization'], $test['content'], $test['rating'], $test['sort_order']]);
    }
    echo "Testimonials seeded.\n";

    // 8. FAQS
    $pdo->exec("DELETE FROM `faqs`");
    $faqs = [
        [
            'category' => 'General Construction',
            'question' => 'How do I request a construction quote or schedule a site inspection?',
            'answer' => 'You can use our online "Request a Quote" portal or call our engineering team directly at 08035188495 / 08065833345. We will arrange a consultation and site assessment to prepare a comprehensive bill of quantities (BOQ).',
            'sort_order' => 1
        ],
        [
            'category' => 'Operations & Locations',
            'question' => 'What geographic areas does SOLARAC Company LTD cover?',
            'answer' => 'While our headquarters are in Osogbo, Osun State, we manage major civil engineering, building construction, and foundation projects across South-West Nigeria (Lagos, Oyo, Osun, Ogun, Ondo, Ekiti) and execute specialized contracts nationwide.',
            'sort_order' => 2
        ],
        [
            'category' => 'Timelines & Delivery',
            'question' => 'How long does a typical civil construction project take to complete?',
            'answer' => 'Project timelines depend on project scale and complexity. Residential structures typically require 3 to 8 months, while large-scale commercial complexes, institutional buildings, and infrastructure projects range from 6 to 18 months under strict CPM scheduling.',
            'sort_order' => 3
        ],
        [
            'category' => 'Design & Permits',
            'question' => 'Do you provide architectural design, structural analysis, and statutory approvals?',
            'answer' => 'Yes. SOLARAC provides turnkey design-build solutions including architectural drawings, COREN-certified structural calculations, soil test coordination, EIA compliance, and assistance with statutory building approvals.',
            'sort_order' => 4
        ],
        [
            'category' => 'Certifications & Compliance',
            'question' => 'Is SOLARAC registered and certified for public and federal contracts?',
            'answer' => 'Yes. SOLARAC Company LTD is registered with the Corporate Affairs Commission (RC: 1175907), certified by the Bureau of Public Procurement (BPP IRR), fully compliant with FIRS, PenCom, and ITF, and our engineers are accredited by COREN and the Nigerian Society of Engineers (NSE).',
            'sort_order' => 5
        ]
    ];
    $stmtFaq = $pdo->prepare("INSERT INTO `faqs` (`question`, `answer`, `category`, `sort_order`, `status`) VALUES (?, ?, ?, ?, 'published')");
    foreach ($faqs as $fq) {
        $stmtFaq->execute([$fq['question'], $fq['answer'], $fq['category'], $fq['sort_order']]);
    }
    echo "FAQs seeded.\n";

    // 9. BLOG POSTS
    $pdo->exec("DELETE FROM `blog_posts`");
    $pdo->exec("DELETE FROM `blog_categories`");
    
    $pdo->exec("INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`) VALUES 
        (1, 'Engineering Insights', 'engineering-insights', 'Technical breakdowns and civil engineering standards'),
        (2, 'Project Spotlights', 'project-spotlights', 'Case studies from landmark construction deliveries'),
        (3, 'Construction Standards', 'construction-standards', 'Quality control and regulatory best practices')");

    $posts = [
        [
            'category_id' => 1,
            'title' => 'Structural Best Practices for Raft Foundations in Coastal Nigerian Terrains',
            'slug' => 'structural-best-practices-raft-foundations-coastal-nigeria',
            'excerpt' => 'An engineering breakdown of soil mechanics, load distribution, and water-table mitigation in heavy raft foundations based on our Lekki Scheme 2 project.',
            'content' => '<p>Constructing multi-story residential blocks in coastal regions like Lagos requires specialized geotechnical planning. In this article, our structural engineering team examines the critical steps behind our 40-unit raft foundation project at Lekki Scheme 2, covering soil bearing capacity, moisture protection, and continuous pour techniques.</p><p>By implementing heavy continuous rebar meshes and waterproof grade concrete, settlement risks are completely eliminated.</p>',
            'featured_image' => 'assets/images/projects/foundation work (1).jpeg'
        ],
        [
            'category_id' => 2,
            'title' => 'Delivering Excellence in Educational Infrastructure: The Ataoja Model School Case Study',
            'slug' => 'delivering-excellence-ataoja-model-school-case-study',
            'excerpt' => 'A detailed look at how SOLARAC executed the turnkey engineering supervision and construction of Ataoja Model School of Science in Osogbo.',
            'content' => '<p>High-quality educational facilities require durable construction, proper acoustic insulation, natural ventilation, and flexible learning layouts. Learn how SOLARAC managed the construction and supervision of Ataoja Model School of Science to deliver an enduring academic landmark for Osun State.</p>',
            'featured_image' => 'assets/images/projects/completed ataoja.jpeg'
        ],
        [
            'category_id' => 3,
            'title' => 'The Strategic Importance of Fair-Faced Reinforced Concrete in Industrial Perimeter Security',
            'slug' => 'fair-faced-reinforced-concrete-industrial-security',
            'excerpt' => 'Why industrial free trade zones and critical infrastructure rely on high-strength reinforced concrete fences for security and longevity.',
            'content' => '<p>Industrial free trade zones demand perimeter barriers that resist environmental weathering, unauthorized intrusion, and soil shifting. This article explores the design and construction of the 300m reinforced concrete fence engineered by SOLARAC for the Livingspring Free Trade Zone.</p>',
            'featured_image' => 'assets/images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg'
        ]
    ];

    $stmtBlog = $pdo->prepare("INSERT INTO `blog_posts` (`category_id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `published_at`) 
                              VALUES (?, 1, ?, ?, ?, ?, ?, 'Published', NOW())");
    foreach ($posts as $b) {
        $stmtBlog->execute([
            $b['category_id'],
            $b['title'],
            $b['slug'],
            $b['excerpt'],
            $b['content'],
            $b['featured_image']
        ]);
    }
    echo "Blog posts seeded.\n";

    $pdo->exec("UPDATE `users` SET `email` = 'admin@solaraccompany.com', `full_name` = 'SOLARAC Administrator' WHERE `id` = 1");
    echo "Admin user updated.\n";
    $pdo->commit();
    echo "SOLARAC Company LTD Database Seeding Completed Successfully!\n";

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}
