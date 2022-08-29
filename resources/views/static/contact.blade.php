<x-layout title="Contact Us">
    <h1 class="h2 text-center">Contact Us</h1>
    <section class="card-deck">
        <div class="card mb-4 box-shadow">
            <div class="card-body">
                <p class="font-weight-bold mb-0">Email:</p>
                <p><a href="mailto:{{ @config('mail.from.address') }}">{{ @config('mail.from.address') }}</a></p>

                <p class="font-weight-bold mb-0">Phone:</p>
                <p> (206) 000-0000</p>

                <p class="font-weight-bold mb-0">Mailing address:</p>
                <ul class="list-unstyled mt-0">
                    <li>Larclad</li>
                    <li>1600 7th Avenue</li>
                    <li>Suite #1100</li>
                    <li>Seattle, WA 98101</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Send us a message</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Your email address</label>
                        <input type="email" name="email" class="form-control" id="email"
                               placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control" id="subject" name="subject" required>
                            <option value="account">Account issues</option>
                            <option value="fraud">Scam or fraud</option>
                            <option value="feedback">Feedback</option>
                            <option value="other" selected>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Your message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" minlength="10"
                                  maxlength="10000" placeholder="Write your message here" required></textarea>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
