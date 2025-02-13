<p><span>Title: </span>{{ $additionalData['Title'] ?? 'Unknown title' }}</p>
<p><span>Type: </span>Season</p>
<p><span>Season: </span>{{ $details['Season'] }} (Total: {{$details['totalSeasons']}})</p>
<p><span>Genre: </span>{{ $additionalData['Genre'] ?? 'Unknown genre' }}</p>
<p><span>Director: </span>{{ $additionalData['Director'] ?? 'Unknown director' }}</p>
<p><span>Writer: </span>{{ $additionalData['Writer'] ?? 'Unknown writer' }}</p>
<p><span>Actors: </span>{{ $additionalData['Actors'] ?? 'Unknown actors' }}</p>
<p><span>Language: </span>{{ $additionalData['Language'] ?? 'Unknown language' }}</p>
<p><span>Awards: </span>{{ $additionalData['Awards'] ?? 'Unknown awards' }}</p>
