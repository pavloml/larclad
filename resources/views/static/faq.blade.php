<x-layout title="Frequently Asked Questions">
    <h1 class="h2 text-center mt-2 mb-4">Frequently Asked Questions</h1>
    <div class="accordion" id="faq">

        <div class="card">
            <div class="card-header" id="newPost">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#newPostCollapse" aria-expanded="true" aria-controls="newPostCollapse">
                        How can I post a new ad?
                    </button>
                </h2>
            </div>

            <div id="newPostCollapse" class="collapse show" aria-labelledby="newPost" data-parent="#faq">
                <div class="card-body">
                    <div class="alert alert-info">
                    In order to post a new ad you need to <a href="{{ @route('login') }}">log in</a>. If you don't have
                    an account you can create it using <a href="{{ @route('register') }}">this link</a>.
                    <br>
                    Don't forget to verify your email before posting. Check your email box for a verification link.
                    </div>
                    <ol class="mt-2">
                        <li>Click "Post free ad" button</li>
                        <li>Enter a title</li>
                        <li>Choose a city</li>
                        <li>Choose a category</li>
                        <li>Enter a price or leave it blank (the price field isn't available for some categories)</li>
                        <li>Enter a description (at least 10 characters)</li>
                        <li>Add an image or skip this step</li>
                        <li>Click "Create ad" button</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="replyToPost">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#replyToPostCollapse" aria-expanded="false" aria-controls="replyToPostCollapse">
                        How can I reply to an ad?
                    </button>
                </h2>
            </div>
            <div id="replyToPostCollapse" class="collapse" aria-labelledby="replyToPost" data-parent="#faq">
                <div class="card-body">
                    <p>You can contact the advertiser in two ways:</p>
                    <ol>
                        <li>Click on "Phone number" button to get the contact phone number</li>
                        <li>Click on "Message" button to send a message. This action requires an account</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="editOrDelete">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#editOrDeleteCollapse" aria-expanded="false" aria-controls="editOrDeleteCollapse">
                        How can I edit or delete my ad?
                    </button>
                </h2>
            </div>
            <div id="editOrDeleteCollapse" class="collapse" aria-labelledby="editOrDelete" data-parent="#faq">
                <div class="card-body">
                    <ol>
                        <li>Log in to your account. If you are already logged in click on "Your profile" link at the
                            top
                        </li>
                        <li>Find the ad you want to edit or delete and click on the respective button</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--    <ul class="list-group">--}}
    {{--        <li class="list-group-item"><a href="#question1">Question 1</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question2">Question 2</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question3">Question 3</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question4">Question 4</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question5">Question 5</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question6">Question 6</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question7">Question 7</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question8">Question 8</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question9">Question 9</a></li>--}}
    {{--        <li class="list-group-item"><a href="#question10">Question 10</a></li>--}}
    {{--    </ul>--}}

    {{--    <h2 id="question1">Question1</h2>--}}
    {{--    <p>--}}
    {{--        Mauris nibh eu nascetur senectus duis mauris cubilia fermentum dolor. Tristique bibendum quam posuere cubilia vulputate habitant. Quam turpis hac vehicula sagittis laoreet purus dictum. At per, ultrices facilisis potenti scelerisque eu. Felis, habitant ante massa mus. Dignissim integer placerat semper tempor. Dolor condimentum ad lorem quam vivamus porta purus. Eros dapibus suspendisse fermentum! Eleifend pellentesque tincidunt ultrices!--}}
    {{--    </p>--}}
    {{--    <h2 id="question2">question 2</h2>--}}
    {{--    <p>--}}
    {{--        Cum aptent tempor volutpat etiam inceptos. Vehicula mi dis ullamcorper porta ornare conubia diam bibendum pharetra enim. Maecenas volutpat ac, tempus conubia aptent feugiat mus lectus ipsum massa adipiscing. Phasellus sociis convallis nisl dui condimentum metus felis. Cras augue interdum metus ipsum blandit. Habitasse curabitur iaculis ad tortor. Nulla ante dis ante auctor primis posuere enim fames proin sociis aenean augue. Eleifend luctus odio vivamus suscipit libero vulputate elit scelerisque nulla etiam nam. Magnis cum ante consectetur odio nisl. Aliquet erat erat justo massa vitae ornare etiam ut nibh dui. Ipsum.--}}
    {{--    </p>--}}

    {{--    <h2 id="question3">question 3</h2>--}}
    {{--    <p>--}}
    {{--        Lacinia suscipit sociosqu viverra consectetur platea urna consequat etiam himenaeos. Purus ornare interdum consequat. Placerat sociis orci nascetur tortor habitant aliquet cum ante imperdiet? Nibh ultrices mauris etiam eros! Massa interdum turpis suspendisse penatibus dictum proin lectus conubia duis, fringilla netus inceptos. Nascetur nibh at cras fusce sapien elit varius sem. Id ridiculus duis tempus luctus! Amet ac semper, dolor convallis lectus mauris. Iaculis.--}}
    {{--    </p>--}}

    {{--    <h2 id="question4">question 4</h2>--}}
    {{--    <p>--}}
    {{--        Habitant tellus est urna curae; dui lacus dui dolor nulla per morbi in? Primis nibh interdum leo aliquet metus sem platea. Congue fames augue litora metus pharetra risus fames phasellus mollis. Interdum platea lacinia ante sagittis suscipit lacus libero? Justo lorem nec sem dui facilisis a porta. Sit vulputate pulvinar sollicitudin.--}}
    {{--    </p>--}}

    {{--    <h2 id="question5">question 5</h2>--}}
    {{--    <p>--}}
    {{--        Nisi ultricies a neque quisque pharetra faucibus amet nibh netus felis sapien. Taciti semper sollicitudin blandit commodo dictum natoque praesent parturient nisi? Vestibulum a vestibulum dui accumsan metus egestas duis eget tempus. Congue a ante vestibulum pellentesque suspendisse sociis cubilia quisque quam viverra. Ligula lorem ipsum habitasse felis. Vestibulum penatibus maecenas donec tristique adipiscing fusce hendrerit. Donec aptent netus morbi, viverra a nulla nisi aptent leo felis. Fermentum leo, ornare natoque dui. Lacus dictum phasellus tortor elit primis magnis nostra mauris ornare pellentesque commodo?--}}
    {{--    </p>--}}

    {{--    <h2 id="question6">question 6</h2>--}}
    {{--    <p>--}}
    {{--        Vulputate laoreet cum pharetra aenean varius class et interdum quam. Suscipit arcu condimentum orci vitae fermentum. Turpis dictumst aenean habitasse per pulvinar vulputate nullam vitae lacus iaculis elit. Ante taciti habitasse, lacus donec. Ornare sagittis, potenti aliquet. Eros cras condimentum pretium aenean dapibus! Varius curabitur risus augue nostra integer tortor suscipit! Velit fringilla laoreet nascetur inceptos ultricies arcu, pharetra tincidunt feugiat! Porttitor erat feugiat montes cursus consectetur venenatis. Proin aptent.--}}
    {{--    </p>--}}

    {{--    <h2 id="question7">question 7</h2>--}}
    {{--    <p>--}}
    {{--        Pretium ad facilisis, phasellus sed dictum himenaeos sed. Malesuada consequat dictum arcu ultrices sem. Eu feugiat sodales cubilia class curabitur porta sociosqu pulvinar integer volutpat. Sociis adipiscing elit rhoncus pretium habitasse proin class venenatis elementum. Penatibus mattis conubia sagittis nostra varius nostra pulvinar ipsum! Class viverra eget commodo maecenas praesent facilisi velit habitant cum semper congue. Primis tellus aptent tristique lobortis netus tortor sed pharetra suspendisse vitae, sagittis mattis. Augue sed neque sed leo.--}}
    {{--    </p>--}}

    {{--    <h2 id="question8">question 8</h2>--}}
    {{--    <p>--}}
    {{--        Magnis massa tristique volutpat tempor nunc fusce sed suspendisse odio turpis. Odio facilisi dictumst ad consectetur dictumst quam enim at pretium sagittis ultrices. Dignissim orci orci egestas senectus vitae est pretium egestas convallis. Bibendum condimentum fusce, quam primis accumsan fusce. Torquent pulvinar sem vulputate inceptos litora. Senectus tincidunt lacinia penatibus, mollis platea. Per gravida iaculis ante rhoncus nam. Facilisi eget adipiscing suscipit consectetur commodo elit vulputate potenti. Class magna facilisis pellentesque, conubia sociosqu commodo nisl nibh consectetur. Laoreet montes.--}}
    {{--    </p>--}}

    {{--    <h2 id="question9">question 9</h2>--}}
    {{--    <p>--}}
    {{--        Consequat sodales sem urna, adipiscing purus conubia nam laoreet turpis. Commodo aenean egestas magna aliquet penatibus metus semper nulla placerat quam etiam bibendum. Ac neque varius vestibulum tortor curabitur ligula nibh sociis? Montes ullamcorper auctor metus morbi ultrices libero ad torquent. Sit ligula penatibus facilisis vestibulum fermentum rhoncus, ultricies arcu dictumst. Parturient aliquet iaculis ligula lacinia tellus malesuada nullam tempus faucibus sapien. Quam maecenas montes nisl sodales, posuere sodales nisi nibh! Hac nam nulla platea parturient elementum magna etiam class consectetur, class conubia nisi. Consectetur placerat integer tellus risus donec ornare massa!--}}
    {{--    </p>--}}

    {{--    <h2 id="question10">question 10</h2>--}}
    {{--    <p>--}}
    {{--        Posuere quis facilisi nam malesuada est risus curabitur congue consequat vitae. Mauris pulvinar nullam adipiscing pharetra nisl taciti, mi inceptos placerat integer metus! Volutpat parturient purus dis pulvinar, tincidunt vel lorem arcu netus at dictum potenti. Proin praesent aptent velit ullamcorper facilisis adipiscing vivamus. Maecenas dis, mollis sapien varius praesent porttitor platea non lacus. Nostra magna a nulla sollicitudin dui pharetra pharetra lobortis. Laoreet etiam semper.--}}
    {{--    </p>--}}
</x-layout>
