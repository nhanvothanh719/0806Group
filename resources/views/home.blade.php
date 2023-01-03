@extends('layouts.main')

@section('title','Home')

@section('content')
@include('_shared._header')
<div class="card text-white bg-secondary my-5 py-3 text-center">
    <div class="card-body">
        <p class="text-white m-0" style="font-family: Georgia, serif;">
            More information about University of Greenwich
        </p>
        <i class="fas fa-arrow-down"></i>
    </div>
</div>
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row align-items-center my-5">
        <div class="mb-5">
            <div class="card h-100 border-light">
            <img class="card-img-top" src="https://greenwich.edu.vn/wp-content/uploads/2020/07/greenwich-lot-top-8-truong-dai-hoc-hang-dau-the-gioi.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text h6" style="text-indent: 50px; font-family: Tahoma, sans-serif;">Located in southeast London and Kent,
                    Greenwich University is not only famous for its outstanding teaching quality, research brilliance,
                    student diversity, and historic campuses, but also for the high satisfaction of students. </p>
                </div>
            </div>
        </div>
        <iframe height="500px" weight="600px" src="https://www.youtube.com/embed/oOD96ZHeD9c" title="Introduction Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-info">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0017/6155/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">Undergraduate study</h2>
                    <p class="card-text">At the University of Greenwich, students can pursue an undergraduate degree. In fact,
                        there are over 200 options for people who want to find the perfect course and as well as
                        learn more about the student experience. </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-warning">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0008/120041/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">Postgraduate study</h2>
                    <p class="card-text">The majority of its postgraduate programs provide a variety of learning choices, including distance learning and part-time study.
                        In case people search for the perfect course, facilities and subjects of
                        Greenwich University specialists could be discovered. </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100 border-success">
            <img class="card-img-top" src="https://www.gre.ac.uk/__data/assets/image/0015/6504/varieties/v800.jpg" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title h4">International study</h2>
                    <p class="card-text">For international students, the University of Greenwich offers a wide range of courses and study options.
                        Moreover, those who intend to continue their education in the United Kingdom can be assisted.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
