function deleteMission(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ?')) {
        fetch(url_to('mission_delete'), {
            method: 'POST',
            
    })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Mission supprimée avec succès !');
                    window.location.reload();
                } else {
                    alert('Erreur lors de la suppression.');
                }
            })
            .catch(error => console.error('Erreur:', error));
    }
}