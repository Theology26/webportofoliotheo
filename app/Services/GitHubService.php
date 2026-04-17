<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubService
{
    /**
     * Fetch GitHub Data and calculate necessary stats.
     */
    public function fetchGitHubData()
    {
        return Cache::remember('github_portfolio_data', 86400, function () {
            $username = 'Theology26';
            $token = env('GITHUB_TOKEN');

            $headers = [
                'Accept' => 'application/vnd.github.v3+json',
            ];

            if ($token) {
                $headers['Authorization'] = 'Bearer ' . $token;
            }

            try {
                $response = Http::withHeaders($headers)
                    ->get("https://api.github.com/users/{$username}/repos?per_page=100&type=owner&sort=updated");

                if ($response->failed()) {
                    return $this->defaultFallbackData();
                }

                $repos = $response->json();

                if (!is_array($repos)) {
                    return $this->defaultFallbackData();
                }

                $languagesCount = [];
                $totalLanguageRepos = 0;
                $repoStats = [];

                foreach ($repos as $repo) {
                    if (is_array($repo) && !empty($repo['language'])) {
                        $lang = $repo['language'];
                        if (!isset($languagesCount[$lang])) {
                            $languagesCount[$lang] = 0;
                        }
                        $languagesCount[$lang]++;
                        $totalLanguageRepos++;
                    }

                    if (is_array($repo)) {
                        $repoStats[] = [
                            'name' => $repo['name'],
                            'stars' => $repo['stargazers_count'] ?? 0,
                            'size' => $repo['size'] ?? 0,
                        ];
                    }
                }

                // Calculate percentages
                $languagePercentages = [];
                if ($totalLanguageRepos > 0) {
                    arsort($languagesCount);
                    foreach ($languagesCount as $lang => $count) {
                        $languagePercentages[$lang] = round(($count / $totalLanguageRepos) * 100, 1);
                    }
                }

                // Get top 5 repos by stars (or size if no stars)
                usort($repoStats, function ($a, $b) {
                    if ($a['stars'] == $b['stars']) {
                        return $b['size'] <=> $a['size'];
                    }
                    return $b['stars'] <=> $a['stars'];
                });
                
                $topRepos = array_slice($repoStats, 0, 5);

                return [
                    'languages' => $languagePercentages,
                    'top_repos' => $topRepos
                ];
            } catch (\Exception $e) {
                return $this->defaultFallbackData();
            }
        });
    }

    private function defaultFallbackData()
    {
        return [
            'languages' => [
                'PHP' => 60,
                'JavaScript' => 20,
                'Blade' => 10,
                'CSS' => 10,
            ],
            'top_repos' => [
                ['name' => 'Portfolio', 'stars' => 0, 'size' => 1024],
                ['name' => 'mbg-smart-logistics', 'stars' => 1, 'size' => 2048],
            ]
        ];
    }
}
