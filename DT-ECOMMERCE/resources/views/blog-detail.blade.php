@extends('layouts.app')
@section('content')

<section class="aboutus-banner mb-5">
    <div class="overlay"></div>
    <div class="container z-2 position-relative">
        <div class="row">
            <div class="col-lg-12 text-center"> <!-- Added text-center class -->
                <h1>BLOG DETAIL</h1>
                {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> --}}
                {{-- <a href="#" class="my-btn">shop now!</a> --}}
            </div>
        </div>
    </div>
</section>

<section>
  <div class="container my-5">
    <div class="row g-5">
      <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
          From the Firehose
        </h3>
  
        <article class="blog-post">
          <h2 class="display-5 link-body-emphasis mb-1">Sample blog post</h2>
          <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>
  
          <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, lists, tables, images, code, and more are all supported as expected.</p>
          <hr>
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <h2>Blockquotes</h2>
          <p>This is an example blockquote in action:</p>
          <blockquote class="blockquote">
            <p>Quoted text goes here.</p>
          </blockquote>
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <h3>Example lists</h3>
          <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout. This is an example unordered list:</p>
          <ul>
            <li>First list item</li>
            <li>Second list item with a longer description</li>
            <li>Third list item to close it out</li>
          </ul>
          <p>And this is an ordered list:</p>
          <ol>
            <li>First list item</li>
            <li>Second list item with a longer description</li>
            <li>Third list item to close it out</li>
          </ol>
          <p>And this is a definition list:</p>
          <dl>
            <dt>HyperText Markup Language (HTML)</dt>
            <dd>The language used to describe and define the content of a Web page</dd>
            <dt>Cascading Style Sheets (CSS)</dt>
            <dd>Used to describe the appearance of Web content</dd>
            <dt>JavaScript (JS)</dt>
            <dd>The programming language used to build advanced Web sites and applications</dd>
          </dl>
          <h2>Inline HTML elements</h2>
          <p>HTML defines a long list of available inline tags, a complete list of which can be found on the <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element">Mozilla Developer Network</a>.</p>
          <ul>
            <li><strong>To bold text</strong>, use <code class="language-plaintext highlighter-rouge">&lt;strong&gt;</code>.</li>
            <li><em>To italicize text</em>, use <code class="language-plaintext highlighter-rouge">&lt;em&gt;</code>.</li>
            <li>Abbreviations, like <abbr title="HyperText Markup Language">HTML</abbr> should use <code class="language-plaintext highlighter-rouge">&lt;abbr&gt;</code>, with an optional <code class="language-plaintext highlighter-rouge">title</code> attribute for the full phrase.</li>
            <li>Citations, like <cite>— Mark Otto</cite>, should use <code class="language-plaintext highlighter-rouge">&lt;cite&gt;</code>.</li>
            <li><del>Deleted</del> text should use <code class="language-plaintext highlighter-rouge">&lt;del&gt;</code> and <ins>inserted</ins> text should use <code class="language-plaintext highlighter-rouge">&lt;ins&gt;</code>.</li>
            <li>Superscript <sup>text</sup> uses <code class="language-plaintext highlighter-rouge">&lt;sup&gt;</code> and subscript <sub>text</sub> uses <code class="language-plaintext highlighter-rouge">&lt;sub&gt;</code>.</li>
          </ul>
          <p>Most of these elements are styled by browsers with few modifications on our part.</p>
          <h2>Heading</h2>
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <h3>Sub-heading</h3>
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <pre><code>Example code block</code></pre>
          <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout.</p>
        </article>
  
        <article class="blog-post">
          <h2 class="display-5 link-body-emphasis mb-1">Another blog post</h2>
          <p class="blog-post-meta">December 23, 2020 by <a href="#">Jacob</a></p>
  
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <blockquote>
            <p>Longer quote goes here, maybe with some <strong>emphasized text</strong> in the middle of it.</p>
          </blockquote>
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <h3>Example table</h3>
          <p>And don't forget about tables in these posts:</p>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Upvotes</th>
                <th>Downvotes</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Alice</td>
                <td>10</td>
                <td>11</td>
              </tr>
              <tr>
                <td>Bob</td>
                <td>4</td>
                <td>3</td>
              </tr>
              <tr>
                <td>Charlie</td>
                <td>7</td>
                <td>9</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td>Totals</td>
                <td>21</td>
                <td>23</td>
              </tr>
            </tfoot>
          </table>
  
          <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout.</p>
        </article>
  
        <article class="blog-post">
          <h2 class="display-5 link-body-emphasis mb-1">New feature</h2>
          <p class="blog-post-meta">December 14, 2020 by <a href="#">Chris</a></p>
  
          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <ul>
            <li>First list item</li>
            <li>Second list item with a longer description</li>
            <li>Third list item to close it out</li>
          </ul>
          <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout.</p>
        </article>
  
        <nav class="blog-pagination" aria-label="Pagination">
          <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
          <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
        </nav>
  
      </div>
  
      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
  
          <div>
            <h4 class="fst-italic">Recent posts</h4>
            <ul class="list-unstyled">
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">Sample Blog Post</h6>
                    <small class="text-body-secondary">January 15, 2024</small>
                  </div>
                </a>
              </li>
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">Sample Blog Post</h6>
                    <small class="text-body-secondary">January 14, 2024</small>
                  </div>
                </a>
              </li>
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">Sample Blog Post</h6>
                    <small class="text-body-secondary">January 13, 2024</small>
                  </div>
                </a>
              </li>
            </ul>
          </div>
  

        </div>
      </div>
    </div>
  </div>
  

</section>




@endsection

