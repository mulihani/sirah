<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Resume;
use App\Models\SocialLink;
use App\Models\Work;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // ═══ Social Links ═══
        $socials = [
            ['platform' => 'GitHub', 'url' => 'https://github.com', 'icon' => 'fab fa-github', 'sort_order' => 1],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com', 'icon' => 'fab fa-x-twitter', 'sort_order' => 2],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => 'fab fa-linkedin', 'sort_order' => 3],
            ['platform' => 'Dribbble', 'url' => 'https://dribbble.com', 'icon' => 'fab fa-dribbble', 'sort_order' => 4],
        ];
        foreach ($socials as $social) {
            SocialLink::updateOrCreate(['platform' => $social['platform']], $social);
        }

        // ═══ Profiles ═══
        \App\Models\Profile::updateOrCreate(['language' => 'en'], [
            'title' => 'John Doe',
            'hero_title' => 'Full Stack Developer',
            'hero_subtitle' => 'Building elegant solutions to complex problems',
            'about_title' => 'A Little About Me',
            'about_me' => 'I follow a minimalist design philosophy and focus on performance and usability. With over 5 years of experience in the Laravel ecosystem...',
            'profile_photo' => 'profiles/photos/default.png',
            'about_photo' => 'profiles/about/default.png',
            'stats' => [
                ['label' => 'Experience', 'value' => '5+ Years'],
                ['label' => 'Projects', 'value' => '50+'],
                ['label' => 'Clients', 'value' => '30+'],
            ],
        ]);

        \App\Models\Profile::updateOrCreate(['language' => 'ar'], [
            'title' => 'جون دو',
            'hero_title' => 'مطور ويب متكامل',
            'hero_subtitle' => 'بناء حلول أنيقة للمشاكل المعقدة',
            'about_title' => 'نبذة عني',
            'about_me' => 'أتبع فلسفة تصميم بسيطة وأركز على الأداء وسهولة الاستخدام. مع أكثر من 5 سنوات من الخبرة في بيئة Laravel العمل...',
            'profile_photo' => 'profiles/photos/default.png',
            'about_photo' => 'profiles/about/default.png',
            'stats' => [
                ['label' => 'الخبرة', 'value' => '٥+ سنوات'],
                ['label' => 'المشاريع', 'value' => '٥٠+'],
                ['label' => 'العملاء', 'value' => '٣٠+'],
            ],
        ]);

        // ═══ Categories ═══
        $catEn = Category::updateOrCreate(
            ['slug' => 'web-development', 'language' => 'en'],
            ['name' => 'Web Development', 'type' => 'work']
        );
        $catAr = Category::updateOrCreate(
            ['slug' => 'تطوير-الويب', 'language' => 'ar'],
            ['name' => 'تطوير الويب', 'type' => 'work']
        );

        // ═══ Works (English) ═══
        $worksEn = [
            [
                'title' => 'Portfolio Platform',
                'slug' => 'portfolio-platform',
                'description' => [
                    ['type' => 'rich_text', 'data' => ['content' => '<p>A modern personal portfolio platform built with Laravel and Tailwind CSS.</p>']],
                    [
                        'type' => 'feature_grid',
                        'data' => [
                            'features' => [
                                ['icon' => 'fas fa-rocket', 'title' => 'Fast', 'text' => 'Optimized for speed.'],
                                ['icon' => 'fas fa-shield-alt', 'title' => 'Secure', 'text' => 'Built-in security best practices.'],
                            ]
                        ]
                    ],
                ],
                'language' => 'en',
                'category_id' => $catEn->id,
                'sort_order' => 1,
                'published_at' => now(),
            ],
            [
                'title' => 'E-Commerce Dashboard',
                'slug' => 'ecommerce-dashboard',
                'description' => [
                    ['type' => 'rich_text', 'data' => ['content' => '<p>Feature-rich admin dashboard for managing products, orders, and analytics.</p>']],
                ],
                'language' => 'en',
                'category_id' => $catEn->id,
                'sort_order' => 2,
                'published_at' => now(),
            ],
            [
                'title' => 'Mobile Banking App',
                'slug' => 'mobile-banking-app',
                'description' => '<p>Secure and intuitive mobile banking application with real-time notifications.</p>',
                'language' => 'en',
                'category_id' => $catEn->id,
                'sort_order' => 3,
                'published_at' => now(),
            ],
        ];

        foreach ($worksEn as $data) {
            Work::updateOrCreate(
                ['slug' => $data['slug'], 'language' => 'en'],
                $data
            );
        }

        // ═══ Works (Arabic) ═══
        $worksAr = [
            [
                'title' => 'منصة المحفظة الشخصية',
                'slug' => 'portfolio-platform-ar',
                'description' => [
                    ['type' => 'rich_text', 'data' => ['content' => '<p>منصة محفظة شخصية حديثة مبنية بـ Laravel و Tailwind CSS.</p>']],
                ],
                'language' => 'ar',
                'category_id' => $catAr->id,
                'sort_order' => 1,
                'published_at' => now(),
            ],
        ];

        foreach ($worksAr as $data) {
            Work::updateOrCreate(
                ['slug' => $data['slug'], 'language' => 'ar'],
                $data
            );
        }

        // ═══ Resumes ═══
        Resume::updateOrCreate(['language' => 'en'], [
            'is_active' => true,
            'summary' => 'Passionate full-stack developer with 5+ years of experience building scalable web applications. I love clean code, great UX, and solving complex problems.',
            'experience' => [
                ['title' => 'Senior Developer', 'company' => 'TechCorp', 'period' => '2022 – Present', 'description' => 'Led a team of 5 developers, architected microservices.'],
                ['title' => 'Full-Stack Developer', 'company' => 'StartupXYZ', 'period' => '2019 – 2022', 'description' => 'Built and maintained client-facing web applications.'],
            ],
            'education' => [
                ['degree' => 'BSc Computer Science', 'institution' => 'University of Technology', 'period' => '2015 – 2019'],
            ],
            'skills' => [
                ['name' => 'Laravel', 'level' => 'expert', 'icon' => 'fab fa-laravel', 'show_on_homepage' => true],
                ['name' => 'Vue.js', 'level' => 'advanced', 'icon' => 'fab fa-vuejs', 'show_on_homepage' => true],
                ['name' => 'PHP', 'level' => 'expert', 'icon' => 'fab fa-php', 'show_on_homepage' => true],
                ['name' => 'Tailwind', 'level' => 'advanced', 'icon' => 'fab fa-css3-alt', 'show_on_homepage' => true],
            ],
            'certifications' => [
                ['name' => 'AWS Solutions Architect', 'issuer' => 'Amazon', 'year' => '2023'],
            ],
        ]);

        Resume::updateOrCreate(['language' => 'ar'], [
            'is_active' => true,
            'summary' => 'مطور ويب متكامل شغوف بالبرمجة، أتمتع بخبرة تزيد عن 5 سنوات في بناء تطبيقات ويب قابلة للتطوير. أحب الكود النظيف وتجربة المستخدم الرائعة وحل المشكلات المعقدة.',
            'experience' => [
                ['title' => 'مطور أول', 'company' => 'شركة التقنية', 'period' => '٢٠٢٢ – الآن', 'description' => 'قيادة فريق من 5 مطورين وتصميم البنية التحتية للخدمات المصغرة.'],
                ['title' => 'مطور متكامل', 'company' => 'شركة ناشئة', 'period' => '٢٠١٩ – ٢٠٢٢', 'description' => 'بناء وصيانة تطبيقات الويب الموجهة للعملاء.'],
            ],
            'education' => [
                ['degree' => 'بكالوريوس علوم حاسوب', 'institution' => 'جامعة التقنية', 'period' => '٢٠١٥ – ٢٠١٩'],
            ],
            'skills' => [
                ['name' => 'Laravel', 'level' => 'expert', 'icon' => 'fab fa-laravel', 'show_on_homepage' => true],
                ['name' => 'Vue.js', 'level' => 'advanced', 'icon' => 'fab fa-vuejs', 'show_on_homepage' => true],
                ['name' => 'PHP', 'level' => 'expert', 'icon' => 'fab fa-php', 'show_on_homepage' => true],
                ['name' => 'Tailwind', 'level' => 'advanced', 'icon' => 'fab fa-css3-alt', 'show_on_homepage' => true],
            ],
            'certifications' => [],
        ]);

        // ═══ Pages ═══
        Page::updateOrCreate(['slug' => 'about', 'language' => 'en'], [
            'title' => 'About Me',
            'link_title' => 'About',
            'content' => '<p>Welcome to my portfolio! I\'m a passionate developer who loves creating beautiful and functional web experiences.</p>',
            'is_published' => true,
            'display_position' => 'header',
        ]);

        Page::updateOrCreate(['slug' => 'about-ar', 'language' => 'ar'], [
            'title' => 'عني',
            'link_title' => 'من أنا؟',
            'content' => '<p>مرحباً بك في محفظتي! أنا مطور متحمس يحب إنشاء تجارب ويب جميلة وعملية.</p>',
            'is_published' => true,
            'display_position' => 'header',
        ]);

        $this->command->info('✓ Sample data seeded successfully.');
    }
}
