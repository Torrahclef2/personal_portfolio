<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class projectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Portfolio Website',
                'description' => 'A personal portfolio website to showcase my projects and skills.',
                'image' => 'portfolio.png',
                'github_link' => 'https://github.com/yourusername/portfolio-website',
                'live_link' => 'https://yourportfoliowebsite.com',
            ],
            [
                'title' => 'E-commerce Platform',
                'description' => 'An online platform for buying and selling products.',
                'image' => 'ecommerce.png',
                'github_link' => 'https://github.com/yourusername/ecommerce-platform',            
                'live_link' => 'https://yourecommerceplatform.com', 
            ],

            [
                'title' => 'Blog Application',
                'description' => 'A web application for creating and managing blog posts.',
                'image' => 'blog.png',
                'github_link' => 'https://github.com/yourusername/blog-application',
                'live_link' => 'https://yourblogapplication.com',
            ]
        ]);
    }
}
