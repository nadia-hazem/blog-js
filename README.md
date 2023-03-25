# blog-js

A blog to publish personal articles and exchange with your visitors. Here is the list of features:

<p align=left>
  <a href="https://nadia-hazem.students-laplateforme.io/blog-js/index.php">## DEMO :</a>
 </p>

## Description :

- A home page: It contains the latest articles put online and some call-to-actions.

- A page allowing users to authenticate. On this page, a login and registration form at the click of a button. Registration must be done with an asynchronous request and form checks must be done front and back.

- Once registered and logged in, you are redirected to a page displaying profile information. The user must be able to modify his information without reloading the page.

- A page that presents the different articles of the blog. The page presents a limited number of articles (between 5 and 20) with pagination to see the other articles. This pagination must be done with a GET parameter in the request (example: ?page=1).

- A page that allows you to create articles: The page is only accessible to people who have the roles to write an article (moderators and administrators). Each article is linked to a category.

- A page that displays the content of an article and the associated comments: The retrieval of the article is managed via a parameter in the GET request (ex: ?article=1). This page is therefore a template filled with the information of the corresponding article each time.

- An administration page: This admin panel allows administrators of your site to manage all users, articles, comments, categories, rights, etc.

- All pages must have a header and a footer containing the same links and having the same information.

<p align="center">
<img src="https://github.com/nadia-hazem/blog-js/blob/67b4c551425a4eb6bfdc20e6cb140494752b6808/screenshot.jpg">
</p>



<div align="center" id="top"> 
  <img src="./.github/app.gif" alt="{{app_name}}" />

  &#xa0;

  <!-- <a href="https://{{app_url}}.netlify.app">Demo</a> -->
</div>

<h1 align="center">{{app_name}}</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/{{github}}/{{repository}}?color=56BEB8">
  <img alt="Github language count" src="https://img.shields.io/github/languages/count/{{github}}/{{repository}}?color=56BEB8">
  <img alt="Repository size" src="https://img.shields.io/github/repo-size/{{github}}/{{repository}}?color=56BEB8">
  <img alt="License" src="https://img.shields.io/github/license/{{github}}/{{repository}}?color=56BEB8">
  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/{{github}}/{{repository}}?color=56BEB8" /> -->
  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/{{github}}/{{repository}}?color=56BEB8" /> -->
  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/{{github}}/{{repository}}?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  {{app_name}} 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/{{github}}" target="_blank">Author</a>
</p>

<br>

## :dart: About ##

Describe your project

## :sparkles: Features ##

:heavy_check_mark: Feature 1;\
:heavy_check_mark: Feature 2;\
:heavy_check_mark: Feature 3;

## :rocket: Technologies ##

The following tools were used in this project:

- [Expo](https://expo.io/)
- [Node.js](https://nodejs.org/en/)
- [React](https://pt-br.reactjs.org/)
- [React Native](https://reactnative.dev/)
- [TypeScript](https://www.typescriptlang.org/)

## :white_check_mark: Requirements ##

Before starting :checkered_flag:, you need to have [Git](https://git-scm.com) and [Node](https://nodejs.org/en/) installed.

## :checkered_flag: Starting ##

```bash
# Clone this project
$ git clone https://github.com/{{github}}/{{repository}}

# Access
$ cd {{repository}}

# Install dependencies
$ yarn

# Run the project
$ yarn start

# The server will initialize in the <http://localhost:3000>
```

## :memo: License ##

This project is under license from MIT. For more details, see the [LICENSE](LICENSE) file.


Made with :heart: by <a href="https://github.com/{{github}}" target="_blank">{{author}}</a>

&#xa0;

<a href="#top">Back to top</a>
