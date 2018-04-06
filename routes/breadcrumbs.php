<?php
/**
 * Created by PhpStorm.
 * User: BLOOMGOO.VN
 * Date: 08/06/2017
 * Time: 12:03 PM
 */

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(__('messages.home'), route('home'));
});

Breadcrumbs::register('superadmin.dashboard.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('messages.dashboard'), route('superadmin.dashboard.index'));
});

Breadcrumbs::register('superadmin.users.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.users'), route('superadmin.users.index'));
});

Breadcrumbs::register('superadmin.users.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.users.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.users.create'));
});

Breadcrumbs::register('superadmin.users.show', function($breadcrumbs, $comment)
{
    $breadcrumbs->parent('superadmin.users.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.users.show', $comment->id));
});

Breadcrumbs::register('superadmin.users.edit', function($breadcrumbs, $comment)
{
    $breadcrumbs->parent('superadmin.users.index');
    $breadcrumbs->push(__('messages.update'), route('superadmin.users.edit', $comment->id));
});

#START categoryDocs
Breadcrumbs::register('superadmin.categoryDocs.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.category_docs'), route('superadmin.categoryDocs.index'));
});

Breadcrumbs::register('superadmin.categoryDocs.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.categoryDocs.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.categoryDocs.create'));
});

Breadcrumbs::register('superadmin.categoryDocs.edit', function($breadcrumbs, $categoryDoc)
{
    $breadcrumbs->parent('superadmin.categoryDocs.index');
    $breadcrumbs->push(__('messages.update'), route('superadmin.categoryDocs.edit', $categoryDoc->id));
});

Breadcrumbs::register('superadmin.categoryDocs.show', function($breadcrumbs, $categoryDoc)
{
    $breadcrumbs->parent('superadmin.categoryDocs.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.categoryDocs.show', $categoryDoc->id));
});
#END categoryDocs

# START Documents
Breadcrumbs::register('superadmin.documents.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.document'), route('superadmin.documents.index'));
});
Breadcrumbs::register('superadmin.documents.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.documents.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.documents.create'));
});

Breadcrumbs::register('superadmin.documents.show', function($breadcrumbs, $document)
{
    $breadcrumbs->parent('superadmin.documents.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.documents.show', $document->id));
});

Breadcrumbs::register('superadmin.documents.edit', function($breadcrumbs, $document) {
    $breadcrumbs->parent('superadmin.documents.index');
    $breadcrumbs->push(__('messages.edit'), route('superadmin.documents.edit', $document->id));
});

Breadcrumbs::register('superadmin.documents.import', function($breadcrumbs) {
    $breadcrumbs->parent('superadmin.documents.index');
    $breadcrumbs->push(__('messages.import'), route('superadmin.documents.import'));
});
# END Documents

#Start Post
Breadcrumbs::register('post', function($breadcrumbs)
{
//    $breadcrumbs->parent('');
    $breadcrumbs->push(__('messages.document'), route('post'));
});

Breadcrumbs::register('post.show', function($breadcrumbs, $document)
{
    $breadcrumbs->parent('post');
    $breadcrumbs->push(__('messages.show'), route('post.show', $document->id));
});

Breadcrumbs::register('post.edit', function($breadcrumbs, $document) {
    $breadcrumbs->parent('post');
    $breadcrumbs->push(__('messages.edit'), route('post.edit', $document->id));
});
#End Post

# START File
Breadcrumbs::register('superadmin.files.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.file'), route('superadmin.files.index'));
});
Breadcrumbs::register('superadmin.files.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.files.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.files.create'));
});

Breadcrumbs::register('superadmin.files.show', function($breadcrumbs, $files)
{
    $breadcrumbs->parent('superadmin.files.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.files.show', $files->id));
});

Breadcrumbs::register('superadmin.files.edit', function($breadcrumbs, $files) {
    $breadcrumbs->parent('superadmin.files.index');
    $breadcrumbs->push(__('messages.edit'), route('superadmin.files.edit', $files->id));
});
# END File

# START Offer Post
Breadcrumbs::register('superadmin.offerPosts.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.offer_post'), route('superadmin.offerPosts.index'));
});
Breadcrumbs::register('superadmin.offerPosts.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.offerPosts.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.offerPosts.create'));
});

Breadcrumbs::register('superadmin.offerPosts.show', function($breadcrumbs, $offerPosts)
{
    $breadcrumbs->parent('superadmin.offerPosts.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.offerPosts.show', $offerPosts->id));
});

Breadcrumbs::register('superadmin.offerPosts.edit', function($breadcrumbs, $offerPosts) {
    $breadcrumbs->parent('superadmin.offerPosts.index');
    $breadcrumbs->push(__('messages.edit'), route('superadmin.offerPosts.edit', $offerPosts->id));
});
# END Offer Post

# START Sentences
Breadcrumbs::register('superadmin.sentences.index', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.dashboard.index');
    $breadcrumbs->push(__('messages.sentences'), route('superadmin.sentences.index'));
});
Breadcrumbs::register('superadmin.sentences.create', function($breadcrumbs)
{
    $breadcrumbs->parent('superadmin.sentences.index');
    $breadcrumbs->push(__('messages.create'), route('superadmin.sentences.create'));
});

Breadcrumbs::register('superadmin.sentences.show', function($breadcrumbs, $sentences)
{
    $breadcrumbs->parent('superadmin.sentences.index');
    $breadcrumbs->push(__('messages.show'), route('superadmin.sentences.show', $sentences->id));
});

Breadcrumbs::register('superadmin.sentences.edit', function($breadcrumbs, $sentences) {
    $breadcrumbs->parent('superadmin.sentences.index');
    $breadcrumbs->push(__('messages.edit'), route('superadmin.offerPosts.edit', $sentences->id));
});
# END Sentences