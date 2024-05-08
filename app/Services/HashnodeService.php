<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use stdClass;

class HashnodeService
{
    protected string $host;
    protected string $url;

    public function __construct()
    {
        $this->host = config('services.hashnode.host');
        $this->url = config('services.hashnode.url');
    }

    public function getPosts(): StdClass
    {
        if (request()->has('next')) {
            $after = request()->input('next');
        } else {
            $after = '';
        }

        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                author {
                  followersCount
                }
                posts(first: 9, after: "' . $after . '") {
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

        $publication = $response->object()->data->publication;

        if ($publication === null) {
            abort(400, 'Hashnode host not found');
        }

        return $publication;
    }

    public function getPostsByTag(string $tag): StdClass
    {
        if (request()->has('next')) {
            $after = request()->input('next');
        } else {
            $after = '';
        }

        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                posts(first: 9, after: "' . $after . '", filter: { tagSlugs: ["' . $tag . '"] }) {
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

        $posts = $response->object()->data->publication->posts;

        if ($posts === null) {
            abort(400, 'Hashnode host not found');
        }

        return $posts;
    }

    public function getPost(string $slug): StdClass
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                post(slug: "' . $slug . '") {
                  id
                  title
                  slug
                  canonicalUrl
                  content {
                    html,
                    markdown
                  }
                  readTimeInMinutes
                  publishedAt
                  url
                  responseCount
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
                  },
                  ogMetaData {
                    image,
                  }
                  seo {
                    title,
                    description
                  }
                }
              }
            }'
        ]);

        $post = $response->object()->data->publication->post;

        if ($post === null) {
            abort(404);
        }

        return $post;
    }

    public function getPages(): array
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                id,
                title
                staticPages(first: 10) {
                  edges {
                    node {
                      title
                      slug
                    }
                  }
                }
              }
            }'
        ]);

        $pages = $response->object()->data->publication->staticPages->edges;

        if ($pages === null) {
            abort(400, 'Hashnode host not found');
        }

        return $pages;
    }

    public function getPage(string $slug): StdClass
    {
        $response = Http::post($this->url, [
            'query' => 'query Publication {
              publication(host: "' . $this->host . '") {
                staticPage(slug: "' . $slug . '") {
                  id,
                  title
                  content {
                    html,
                    markdown
                  },
                  ogMetaData {
                    image,
                  }
                  seo {
                    description
                  }
                }
              }
            }'
        ]);

        $page = $response->object()->data->publication->staticPage;

        if ($page === null) {
            abort(404);
        }

        return $page;
    }
}
