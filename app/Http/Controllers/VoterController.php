<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\User;
use App\Models\Sondage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function vote(Request $request, $surveyId, $option)
    {
        $userId = Auth::id();

        // Check if the user has already voted for this survey
        $existingVote = Voter::where('user_id', $userId)
                             ->where('sondage_id', $surveyId)
                             ->first();

        if (!$existingVote) {
            // Register the user's vote
            Voter::create([
                'user_id' => $userId,
                'sondage_id' => $surveyId,
                'option_voted' => $option,
                'option_voted' => $option,
            ]);

            // Update the vote count for the selected option
            $survey = Sondage::findOrFail($surveyId);
            $survey->votes()->updateOrCreate(
                ['option_voted' => $option],
                ['vote_count' => DB::raw('vote_count + 1')]
            );

            // Redirect to the survey view with success message
            return redirect()->route('view.survey', $surveyId)->with('success', 'Vote submitted successfully.');
        } else {
            // Redirect back with error message if user already voted
            return redirect()->back()->withErrors(['error' => 'You have already voted for this survey.']);
        }
    }
    public function show($surveyId)
    {
        $survey = Sondage::findOrFail($surveyId);
        $options = explode(',', $survey->options);
        $voteCounts = [];
    
        // Récupérer les données agrégées des votes à partir de la table Sondage
        $votes = $survey->votes()->get();
    
        foreach ($options as $option) {
            // Initialiser le compteur de votes pour chaque option
            $voteCounts[$option] = 0;
    
            // Parcourir les données agrégées et mettre à jour le compteur de votes
            foreach ($votes as $vote) {
                if ($vote->option_voted === $option) {
                    $voteCounts[$option] += $vote->vote_count;
                }
            }
        }
    
        // Récupérer tous les sondages pour affichage
        $surveys = Sondage::all();
    
        return view('mentorat.pageSondage', compact('survey', 'options', 'voteCounts', 'surveys'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voter $voter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voter $voter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voter $voter)
    {
        //
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
}
