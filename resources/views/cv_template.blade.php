<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $profile->full_name ?? 'Yosia Gracetheo Boimau' }}</title>
    <style>
        /* CSS murni karena dompdf kadang tidak mendukung tailwind fully */
        @page {
            margin: 40px 50px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0f172a; /* Dark Navy */
            line-height: 1.5;
            font-size: 11pt;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4, p {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .name {
            font-size: 28pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        .job-title {
            font-size: 14pt;
            color: #06b6d4; /* Cyan */
            margin-bottom: 10px;
            font-weight: bold;
        }
        .contact-info {
            font-size: 10pt;
            color: #475569;
        }
        .contact-info span {
            margin: 0 5px;
        }
        
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid #06b6d4; /* Cyan divider */
        }
        
        .summary {
            font-size: 10.5pt;
            color: #334155;
            text-align: justify;
        }

        .item {
            margin-bottom: 15px;
        }
        .item-header {
            width: 100%;
            margin-bottom: 4px;
        }
        .item-title {
            font-size: 12pt;
            font-weight: bold;
            color: #0f172a;
        }
        .item-subtitle {
            font-size: 11pt;
            font-weight: bold;
            color: #334155;
        }
        .item-date {
            font-size: 10pt;
            font-style: italic;
            color: #64748b;
            float: right;
        }
        .item-location {
            font-size: 10pt;
            color: #64748b;
        }
        .item-desc {
            font-size: 10.5pt;
            color: #334155;
            margin-top: 4px;
            text-align: justify;
        }
        .item-desc ul {
            margin-top: 5px;
            margin-bottom: 5px;
            padding-left: 20px;
        }
        .item-desc li {
            margin-bottom: 3px;
        }

        .skills-container {
            font-size: 11pt;
            color: #334155;
            line-height: 1.6;
        }
        .skills-category {
            font-weight: bold;
            color: #0f172a;
        }
        .tags {
            font-size: 10pt;
            color: #06b6d4;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1 class="name">{{ $profile->full_name ?? 'Yosia Gracetheo Boimau' }}</h1>
        <div class="job-title">{{ $profile->job_title ?? 'Fullstack Developer' }}</div>
        
        <div class="contact-info">
            {{ $profile->email ?? 'yosiagracetheo0@gmail.com' }}
            @if(isset($profile->address))
                <span>&bull;</span> {{ explode(',', $profile->address)[0] ?? 'Malang' }}
            @endif
            
            @foreach($socialMedias as $sm)
                <span>&bull;</span> 
                {{ $sm->platform }}: {{ str_replace(['https://', 'http://', 'www.'], '', $sm->url) }}
            @endforeach
        </div>
    </div>

    <!-- Professional Summary -->
    @if(isset($profile->hero_subtitle) && trim($profile->hero_subtitle) !== '')
    <div class="section">
        <h2 class="section-title">Professional Summary</h2>
        <div class="summary">
            {{strip_tags($profile->hero_subtitle)}}
        </div>
    </div>
    @endif

    <!-- Experience -->
    @if($experiences->isNotEmpty())
    <div class="section">
        <h2 class="section-title">Experience</h2>
        
        @foreach($experiences as $exp)
        <div class="item">
            <div class="item-header">
                <span class="item-title">{{ $exp->title }}</span>
                <span class="item-date">{{ $exp->year }}</span>
            </div>
            <div class="item-desc">
                {{ $exp->description }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Projects -->
    @if($projects->isNotEmpty())
    <div class="section">
        <h2 class="section-title">Selected Projects</h2>
        
        @foreach($projects as $proj)
        <div class="item">
            <div class="item-header">
                <span class="item-title">{{ $proj->title }}</span>
                @if($proj->tags)
                <span style="font-size: 10pt; color: #475569;"> | <span class="tags">{{ $proj->tags }}</span></span>
                @endif
            </div>
            <div class="item-desc">
                {{ $proj->description }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Skills (If stored somewhere, using default for now or extracting from tags) -->
    <div class="section">
        <h2 class="section-title">Technical Skills</h2>
        <div class="skills-container">
            <?php
                // Extract all unique tags from projects
                $allTags = [];
                foreach($projects as $proj) {
                    if($proj->tags) {
                        $tags = explode(',', $proj->tags);
                        foreach($tags as $t) {
                            $allTags[] = trim($t);
                        }
                    }
                }
                $uniqueTags = array_unique($allTags);
            ?>
            <span class="skills-category">Core Technologies & Tools:</span> 
            @if(count($uniqueTags) > 0)
                {{ implode(', ', $uniqueTags) }}
            @else
                Laravel, PHP, JavaScript, Tailwind CSS, Alpine.js, HTML/CSS, MySQL, Git
            @endif
        </div>
    </div>

</body>
</html>
