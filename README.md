# blog-js

A blog to publish personal articles and exchange with your visitors. Here is the list of features:

- A home page: It contains the latest articles put online and some call-to-actions.

- A page allowing users to authenticate. On this page, a login and registration form at the click of a button. Registration must be done with an asynchronous request and form checks must be done front and back.

- Once registered and logged in, you are redirected to a page displaying profile information. The user must be able to modify his information without reloading the page.

- A page that presents the different articles of the blog. The page presents a limited number of articles (between 5 and 20) with pagination to see the other articles. This pagination must be done with a GET parameter in the request (example: ?page=1).

- A page that allows you to create articles: The page is only accessible to people who have the roles to write an article (moderators and administrators). Each article is linked to a category.

- A page that displays the content of an article and the associated comments: The retrieval of the article is managed via a parameter in the GET request (ex: ?article=1). This page is therefore a template filled with the information of the corresponding article each time.

- An administration page: This admin panel allows administrators of your site to manage all users, articles, comments, categories, rights, etc.

- All pages must have a header and a footer containing the same links and having the same information.

<p center>
<img src="https://github.com/nadia-hazem/blog-js/blob/67b4c551425a4eb6bfdc20e6cb140494752b6808/screenshot.jpg">
</p>
