<form action="{{route('delete.categories', $categorie->id)}}" method="POST">
   @csrf 
   @method('DELETE') 
     
            <div class="modal-body">
                 Vous voulez vraiement supprimer<b>{{$categories->id}}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn gray btn-outline-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn gray btn-outline-danger">Supprimer</button>
            </div>
        </div>
     </div>
 
</form>