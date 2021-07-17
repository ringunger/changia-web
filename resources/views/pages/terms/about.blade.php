@extends('layouts.web')

@section('content')
    <div class="slash" style="height: 60px;">
        <div class="row boxed">
            <h3>About Changia</h3>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row boxed">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <h3>About Changia Platform</h3>
                        <p>
                            This is a project based on a challenge 'Beemathon' by <a href="https://beem.africa">Beem Africa</a>
                            <br/>
                            This is a platform that will enable Organizations, Communities, Companies, Government or Individuals to entreat for money from the community
                            and let the community keep track of what they are contributing.
                            The key advantage of this platform is to give <strong> Transparency </strong> to contributors.
                        </p>


                        <h4 class="mt-3">How It Works</h4>
                        <p>
                        <ul>
                            <li>A person (client) creates an account within the platform</li>

                            <li>The client creates a new need for contribution (Entreaty) and publishes it to the public</li>

                            (If the entreaty is private, the client should send the link to target individuals)

                            <li>Individuals interested in contributing will visit the site and see details of the need/entreaty and if convinced, they will have two options for contribution: (Online or through USSD menu)</li>

                            <li>Whenever individuals contribute, the system will be keeping track of the collections: Target, Collected and Remaining</li>

                            <li>If a target was specified (or if deadline reached) the contribution window will be closed and (if configured) the contributed money will be disbursed to the client's wallet.</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
