<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HashnodeService
{
    protected string $host;
    protected string $url;

    public function __construct()
    {
        $this->host = config('services.hashnode.host');
        $this->url = config('services.hashnode.url');
    }

    public function getPosts(): array
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                author {
                  followersCount
                }
                posts(first: 10) {
                  edges {
                    node {
                      title
                      slug
                      brief
                      readTimeInMinutes
                      publishedAt
                      views
                      url
                      coverImage {
                        url
                      }
                      tags {
                        name
                        slug
                      }
                      author {
                        name
                        username
                        profilePicture
                      }
                    }
                  }
                  pageInfo {
                    endCursor,
                    hasNextPage
                  }
                }
              }
            }'
        ]);

        $publication = $response->json()['data']['publication'];

        if ($publication === null) {
            abort(400, 'Hashnode host not found');
        }

        return $publication;
    }

    public function getPostsByTag(string $tag): array
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                posts(first: 10, filter: { tagSlugs: ["' . $tag . '"] }) {
                  edges {
                    node {
                      title
                      slug
                      brief
                      readTimeInMinutes
                      publishedAt
                      views
                      url
                      coverImage {
                        url
                      }
                      tags {
                        name
                        slug
                      }
                      author {
                        name
                        username
                        profilePicture
                      }
                    }
                  }
                }
              }
            }'
        ]);

        $publication = $response->json()['data']['publication'];

        if ($publication === null) {
            abort(400, 'Hashnode host not found');
        }

        return $publication['posts'];
    }

    public function getPost(string $slug): array
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                post(slug: "' . $slug . '") {
                  title
                  slug
                  content {
                    html,
                    markdown
                  }
                  readTimeInMinutes
                  publishedAt
                  url
                  coverImage {
                    url
                  }
                  tags {
                    name
                    slug
                  }
                  author {
                    name
                    username
                    profilePicture
                  }
                }
              }
            }'
        ]);

        $post = $response->json()['data']['publication']['post'];

        if ($post === null) {
            abort(404);
        }

        return $post;
    }

}
