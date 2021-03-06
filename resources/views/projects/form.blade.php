
   @csrf


    <div class="mb-4">
      
      <label class="block text-grey-darker text-sm font-bold mb-2" for="title">
        Title
      </label>
      <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline  {{ $errors->has('title') ? 'border-red' : '' }}"
          name="title"
          type="text"
          placeholder="Title"
          required
          value="{{ $project->title }}">
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="description">
        description
      </label>
      <textarea 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('description') ? 'border-red' : '' }}" 
            name="description" 
            required
            rows="3">{{ $project->description }}</textarea>
      
    </div>
    <div class="flex items-center justify-between">
      <input class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="{{ $buttonText }}">
    <a href="{{ $project->path() }}" class="bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
       
    </div>
    
    @if ($errors->any())
    <div class="field mt-5 text-red">

      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      
    </div>
    @endif
    