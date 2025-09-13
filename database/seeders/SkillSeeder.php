<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Graphic Design',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'CorelDRAW',
            'Affinity Designer',
            'Sketch (UI/UX design, Mac only)',
            'Canva',
            'Figma (UI/UX + collaborative design)',
            'Adobe XD',
            'InVision Studio',
            'Zeplin',
            'Axure RP',
            'Marvel App',
            'GIMP (open-source alternative)',
            'Affinity Photo',
            'Luminar Neo',
            'Capture One',
            'Adobe Premiere Pro',
            'Final Cut Pro (Mac)',
            'DaVinci Resolve',
            'Sony VEGAS Pro',
            'iMovie (Mac)',
            'Blender (free, also for 3D + VFX)',
            'Blender',
            'Autodesk Maya',
            'Autodesk 3ds Max',
            'Cinema 4D',
            'ZBrush (sculpting)',
            'Houdini (VFX & procedural modeling)',
            'CAD & Industrial Design',
            'AutoCAD',
            'SolidWorks',
            'Fusion 360',
            'CATIA',
            'Rhino 3D',
            'TinkerCAD (beginner-friendly)',
            'Affinity Publisher',
            'Scribus (open-source)',
            'Sketch',
            'Adobe Dreamweaver',
            'Webflow',
            'Wix Editor / Studio',
        ];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
