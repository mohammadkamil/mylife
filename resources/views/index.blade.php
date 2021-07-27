@extends('layouts.app')
@section('content')
    <section class="portfolio-block skills" style="border-bottom: 0">

        <div class="container">
            <div class="heading">
                <h2>New posts</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postmodal">
                    Add New Post
                </button>

            </div>

            <div class="row">
                <div class="col" id="post-body">
                    {{-- <div class="card">
                        <div class="card-body" >

                        </div> --}}
                    <script>
                        $(document).ready(function() {
                            // put Ajax here.

                            // event.preventDefault();

                            var formData = {
                                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                token: '{{ $_COOKIE['jwt'] }}',


                            };
                            $.ajax({

                                type: "get",
                                url: "http://127.0.0.1:8000/api/posts",
                                data: formData,
                                dataType: "json",
                                encode: true,
                            }).done(function(data) {
                                console.log(data);
                                var post = data['post']['data'];
                                var user = data['user'];

                                if (post.length > 0) {
                                    post.forEach(element => {
                                        var like = element['like'];
                                        if (element['user_id'] == user['id']) {
                                            //if post own by user
                                            var appendpost =
                                                '<div class="card" style="margin-bottom:1.5%" id="card_' + element[
                                                    'id'] + '"><div class="card-body" onclick="viewpost(' +
                                                element['id'] + ')"><p class="card-text">' +
                                                element['post'] +
                                                '</p></div><div class="card-footer" id="footer_' + element['id'] +
                                                '">';
                                            if (like.length > 0) {

                                                appendpost = appendpost +
                                                    '<a class="card-link"  onclick="likepost(' +
                                                    element['id'] +
                                                    ',2,' + element['liked'] + ')" id="like_' + element['id'] +
                                                    '">liked(' + element['liked'] + ')</a>';
                                            } else {
                                                appendpost = appendpost +
                                                    '<a class="card-link" onclick="likepost(' +
                                                    element['id'] +
                                                    ',1,' + element['liked'] + ')" id="like_' + element['id'] +
                                                    '">like(' + element['liked'] + ')</a>';
                                            }
                                            appendpost = appendpost +
                                                '<a class="card-link" onclick="displaycommentmodal(' +
                                                element['id'] +
                                                ')">comment</a><a class="card-link" onclick="displayeditmodal(' +
                                                element['id'] +
                                                ')">edit</a><a class="card-link" onclick="deletepost(' +
                                                element['id'] + ')">delete</a></div></div>';
                                            $("#post-body").
                                            append(appendpost);
                                        } else {
                                            //if post not own by user

                                            var appendpost =
                                                '<div class="card" style="margin-bottom:1.5%" ><div class="card-body" onclick="viewpost(' +
                                                element['id'] + ')"><p class="card-text">' +
                                                element['post'] +
                                                '</p></div><div class="card-footer" id="footer_' + element['id'] +
                                                '">';
                                            if (like.length > 0) {

                                                appendpost = appendpost +
                                                    '<a class="card-link"  onclick="likepost(' +
                                                    element['id'] +
                                                    ',2,' + element['liked'] + ')" id="like_' + element['id'] +
                                                    '">liked</a>';
                                            } else {
                                                appendpost = appendpost +
                                                    '<a class="card-link" onclick="likepost(' +
                                                    element['id'] +
                                                    ',1,' + element['liked'] + ')" id="like_' + element['id'] +
                                                    '">like</a>';
                                            }

                                            appendpost = appendpost +
                                                '<a class="card-link" onclick="displaycommentmodal(' +
                                                element['id'] +
                                                ')">comment</a></div></div>';
                                            $("#post-body").
                                            append(appendpost);
                                        }


                                    });
                                    if (data['post']['next_page_url'] != null) {
                                        var appendpost =
                                            '<div class="card" style="margin-bottom:1.5%" id="load-more" ><div class="card-body" id="card-load-more"><p class="card-text">Load More</p></div></div>';
                                        $("#post-body").
                                        append(appendpost);
                                        $("#card-load-more").attr("onclick", "loadmore('" +
                                            data['post']['next_page_url'] + "')");


                                    }
                                } else {
                                    $("#post-body").
                                    append(
                                        '<div class="card" style="margin-bottom:1.5%" id="nopost"><div class="card-body"><p class="card-text">No Post</p></div></div>'
                                    );

                                }

                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                $('#postmodal').hide();


                                //handle error here
                            });
                        });
                    </script>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal add post -->
    <div class="modal fade" id="postmodal" tabindex="-1" aria-labelledby="postmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postmodalLabel">Add post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addpost">
                        <input class="form-control" type="text" name="post" id="post" required
                            placeholder="What you want to write.">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addpost()">Post</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit post -->
    <div class="modal fade" id="editpostmodal" tabindex="-1" aria-labelledby="editpostmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpostmodalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addpost">
                        <input class="form-control" type="text" name="editpost" id="editpost" required
                            placeholder="What you want to write.">
                        <input class="form-control" type="text" name="id" id="id" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editpost()">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal view post -->
    <div class="modal fade" id="viewpostmodal" tabindex="-1" aria-labelledby="viewpostmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewpostmodalLabel">View Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="viewpost-post">Comment</h6>
                    <div class="row">
                        <div class="col" id="view-post-body">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Post</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add comment -->
    <div class="modal fade" id="commentmodal" tabindex="-1" aria-labelledby="addcommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcommentLabel">Add comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addpost">
                        <input class="form-control" type="text" name="comment" id="comment" required
                            placeholder="What you want to write.">
                        <input type="text" name="post_id" id="post_id" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addcomment()">Comment</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addpost() {
            // funtion to store new post
            event.preventDefault();

            // postmodal.show();
            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                post: $('#post').val()


            };
            $.ajax({

                type: "post",
                url: "http://127.0.0.1:8000/api/posts",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                // console.log(data);
                $("#post").val("");
                var post = data['post'];
                alert("Successfully add post");
                //                 $("#postmodal").removeClass("in");
                //   $(".modal-backdrop").remove();
                //   $('body').removeClass('modal-open');
                //   $('body').css('padding-right', '');
                //   $("#postmodal").hide();
                $("#postmodal").modal('hide');

                var appendpost =
                    '<div class="card" style="margin-bottom:1.5%" id="card_' + post['id'] +
                    '"><div class="card-body" onclick="viewpost(' +
                    post['id'] + ')"><p class="card-text">' +
                    post['post'] +
                    '</p></div><div class="card-footer" id="footer_' + post['id'] +
                    '">';

                appendpost = appendpost +
                    '<a class="card-link" onclick="likepost(' +
                    post['id'] +
                    ',1,' + post['liked'] + ')" id="like_' + post['id'] +
                    '">likepost(' + post['liked'] + ')</a>';

                appendpost = appendpost +
                    '<a class="card-link" onclick="displaycommentmodal(' +
                    post['id'] +
                    ')">comment</a><a class="card-link" onclick="displayeditmodal(' +
                    post['id'] +
                    ')">edit</a><a class="card-link" onclick="deletepost(' +
                    post['id'] + ')">delete</a></div></div>';
                $("#post-body").
                prepend(appendpost);
                $("#nopost").remove();
                // $("#post-body").children("div[class=card]:last").remove();
                // $(".card:last").remove();


                // location.href = '{{ route('index') }}';
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                postmodal.hide();


                //handle error here
            });

        }

        function displayeditmodal(id) {

            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                post: id


            };
            $.ajax({

                type: "get",
                url: "http://127.0.0.1:8000/api/posts/" + id,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                $("#id").val(data['id'] + "");

                $("#editpost").val(data['post']);
                var editpostmodal = new bootstrap.Modal(document.getElementById('editpostmodal'), {
                    keyboard: false
                })
                editpostmodal.show();
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {


                //handle error here
            });

        }

        function editpost(id) {

            event.preventDefault();
            var editpostmodal = new bootstrap.Modal(document.getElementById('editpostmodal'), {
                keyboard: false
            })
            // editpostmodal.show();
            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                posts: $('#editpost').val(),
                id: $("#id").val()


            };
            var postid = $("#id").val();
            $.ajax({

                type: "put",
                url: "http://127.0.0.1:8000/api/posts/" + postid,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                // console.log(data);

                editpostmodal.hide();
                alert("Successfully edit post");
                location.href = '{{ route('index') }}';
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                editpostmodal.hide();


                //handle error here
            });

        }

        function displaycommentmodal(id) {

            $("#post_id").val(id + "");

            var viewcommentmodal = new bootstrap.Modal(document.getElementById('commentmodal'), {
                keyboard: false
            })
            viewcommentmodal.show();
        }

        function addcomment() {
            var viewcommentmodal = new bootstrap.Modal(document.getElementById('commentmodal'), {
                keyboard: false
            })
            event.preventDefault();

            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                comment: $('#comment').val(),
                post_id: $('#post_id').val()


            };
            $.ajax({

                type: "post",
                url: "http://127.0.0.1:8000/api/comments",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                // console.log(data);

                viewcommentmodal.hide();
                alert("Successfully add comment");
                location.href = '{{ route('index') }}';
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                viewcommentmodal.hide();


                //handle error here
            });

        }

        function likepost(id, type, totallike) {
            // type 0 = for like ,1 for dislike

            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                post_id: id,
                type: type

            };
            $.ajax({

                type: "post",
                url: "http://127.0.0.1:8000/api/like",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                // console.log(data);
                if (type == 1) {
                    totallike = totallike + 1;
                    $("#like_" + id).attr("onclick", "likepost(" + id + ",2," + totallike + ")");
                    $("#like_" + id).html("liked(" + totallike + ")");

                } else {
                    totallike = totallike - 1;

                    $("#like_" + id).attr("onclick", "likepost(" + id + ",1," + totallike + ")");
                    $("#like_" + id).html("like(" + totallike + ")");

                }

                // alert("Successfully like");
                // location.href = '{{ route('index') }}';
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {


                //handle error here
            });

        }

        function viewpost(id) {
            var myModal = new bootstrap.Modal(document.getElementById('viewpostmodal'), {
                keyboard: false
            })
            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                post_id: id


            };
            $.ajax({

                type: "get",
                url: "http://127.0.0.1:8000/api/commentbyid",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                console.log(data['comment']);
                console.log(data['comment']['data']);
                $("#view-post-body").empty();
                $("#viewpostmodalLabel").html(data['post']['post']);
                var user = data['user'];
                console.log(user);

                if (data['comment']['data'].length == 0) {
                    $("#view-post-body").
                    append(
                        '<div class="card" style="margin-bottom:1.5%" ><div class="card-body" ><p class="card-text">No Comment</p></div></div>'
                    );
                } else {
                    var comments = data['comment']['data'];
                    comments.forEach(element => {
                        console.log(user);
                        $("#view-post-body").
                        append('<div class="card" style="margin-bottom:1.5%" onclick="viewpost(' +
                            element['id'] + ')"><div class="card-body" ><p class="card-text">' +
                            element['coment'] +
                            '</p></div></div>');
                        // if (user['id'] == element['user_id']) {
                        //     $("#view-post-body").
                        //     append('<div class="card" style="margin-bottom:1.5%" onclick="viewpost(' +
                        //         element['id'] + ')"><div class="card-body" ><p class="card-text">' +
                        //         element['coment'] +
                        //         '</p></div><div class="card-footer"><a class="card-link" href="" onclick="editpost(' +
                        //         element['id'] +
                        //         ')">edit</a><a class="card-link" href="" onclick="deletepost(' +
                        //         element['id'] + ')">delete</a></div></div>');
                        // } else {
                        //     $("#view-post-body").
                        //     append('<div class="card" style="margin-bottom:1.5%" onclick="viewpost(' +
                        //         element['id'] + ')"><div class="card-body" ><p class="card-text">' +
                        //         element['coment'] +
                        //         '</p></div></div>');
                        // }

                    });
                    if (data['comment']['next_page_url'] != null) {
                        var appendpost =
                            '<div class="card" style="margin-bottom:1.5%" id="load-more"><div class="card-body" id="card-load-more" ><p class="card-text">Load More</p></div></div>';
                        $("#post-body").
                        append(appendpost);
                        $("#card-load-more").attr("onclick", "loadmore('" +
                            data['post']['next_page_url'] + "')");


                    }

                }
                myModal.show();
                // console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {


                //handle error here
            });

        }

        function deletepost(id) {

            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',
                id: id


            };
            $.ajax({

                type: "delete",
                url: "http://127.0.0.1:8000/api/posts/" + id,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                var totalcard = 0;
                alert("Successfully delete post");

                $("#card_" + id).remove();
                $('#post-body .card').each(function() {
                    totalcard = totalcard + 1;
                });
                if (totalcard == 0) {
                    $("#post-body").
                    append(
                        '<div class="card" style="margin-bottom:1.5%" id="nopost"><div class="card-body"><p class="card-text">No Post</p></div></div>'
                    );
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {


                //handle error here
            });

        }

        function loadmore(link) {
            var formData = {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                token: '{{ $_COOKIE['jwt'] }}',


            };
            $.ajax({

                type: "get",
                url: link,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                $("#load-more").remove();
                console.log(data);
                var post = data['post']['data'];
                var user = data['user'];

                // var json=JSON.parse(data);
                if (post.length > 0) {
                    post.forEach(element => {
                        var like = element['like'];
                        // alert(element['post']);
                        if (element['user_id'] == user['id']) {
                            var appendpost =
                                '<div class="card" style="margin-bottom:1.5%" id="card_' + element[
                                    'id'] + '"><div class="card-body" onclick="viewpost(' +
                                element['id'] + ')"><p class="card-text">' +
                                element['post'] +
                                '</p></div><div class="card-footer" id="footer_' + element['id'] +
                                '">';
                            if (like.length > 0) {

                                appendpost = appendpost +
                                    '<a class="card-link"  onclick="likepost(' +
                                    element['id'] +
                                    ',2,' + element['liked'] + ')" id="like_' + element['id'] +
                                    '">liked(' + element['liked'] + ')</a>';
                            } else {
                                appendpost = appendpost +
                                    '<a class="card-link" onclick="likepost(' +
                                    element['id'] +
                                    ',1,' + element['liked'] + ')" id="like_' + element['id'] +
                                    '">like(' + element['liked'] + ')</a>';
                            }
                            appendpost = appendpost +
                                '<a class="card-link" onclick="displaycommentmodal(' +
                                element['id'] +
                                ')">comment</a><a class="card-link" onclick="displayeditmodal(' +
                                element['id'] +
                                ')">edit</a><a class="card-link" onclick="deletepost(' +
                                element['id'] + ')">delete</a></div></div>';
                            $("#post-body").
                            append(appendpost);
                        } else {
                            var appendpost =
                                '<div class="card" style="margin-bottom:1.5%" ><div class="card-body" onclick="viewpost(' +
                                element['id'] + ')"><p class="card-text">' +
                                element['post'] +
                                '</p></div><div class="card-footer" id="footer_' + element['id'] +
                                '">';
                            if (like.length > 0) {

                                appendpost = appendpost +
                                    '<a class="card-link"  onclick="likepost(' +
                                    element['id'] +
                                    ',2,' + element['liked'] + ')" id="like_' + element['id'] +
                                    '">liked</a>';
                            } else {
                                appendpost = appendpost +
                                    '<a class="card-link" onclick="likepost(' +
                                    element['id'] +
                                    ',1,' + element['liked'] + ')" id="like_' + element['id'] +
                                    '">like</a>';
                            }

                            appendpost = appendpost +
                                '<a class="card-link" onclick="displaycommentmodal(' +
                                element['id'] +
                                ')">comment</a></div></div>';
                            $("#post-body").
                            append(appendpost);
                        }


                    });
                    if (data['post']['next_page_url'] != null) {
                        var appendpost =
                            '<div class="card" style="margin-bottom:1.5%" id="load-more"><div class="card-body" id="card-load-more" ><p class="card-text">Load More</p></div></div>';
                        $("#post-body").
                        append(appendpost);
                        $("#card-load-more").attr("onclick", "loadmore('" +
                            data['post']['next_page_url'] + "')");


                    }
                } else {
                    $("#post-body").
                    append(
                        '<div class="card" style="margin-bottom:1.5%"><div class="card-body"><p class="card-text">No Post</p></div></div>'
                    );

                }

            }).fail(function(jqXHR, textStatus, errorThrown) {


                //handle error here
            });
        }
    </script>

@endsection
