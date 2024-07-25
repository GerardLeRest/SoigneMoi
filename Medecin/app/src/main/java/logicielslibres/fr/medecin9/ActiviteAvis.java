package logicielslibres.fr.medecin9;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ActiviteAvis extends AppCompatActivity {

    private static final String TAG = "ActiviteAvis";
    private EditText libelle;
    private EditText prenomMedecin;
    private EditText nomMedecin;
    private EditText idPatient;
    private EditText date;
    private EditText descriptionAvis;
    private Map<String, String> tableauAvis;
    private ApiService apiService;

    public ActiviteAvis() {
        tableauAvis = new HashMap<>();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activite_avis);

        // Initialisation des vues
        libelle = findViewById(R.id.libelle);
        prenomMedecin = findViewById(R.id.prenomMedecin);
        nomMedecin = findViewById(R.id.nomMedecin);
        idPatient = findViewById(R.id.idPatient); // sera transformé en entier dans le contrôleur
        date = findViewById(R.id.date);
        descriptionAvis = findViewById(R.id.descriptionAvis);

        /// Ajouter le listener pour le champ de date
        date.setOnClickListener(v -> {
            showDatePickerDialog(date);
        });

        // Configuration du bouton précédent
        Button boutonPrecedent = findViewById(R.id.boutonPrecedent);
        boutonPrecedent.setOnClickListener(v -> pagePrecedente());

        // Configuration du bouton suivant
        Button boutonSuivant = findViewById(R.id.boutonSuivant);
        boutonSuivant.setOnClickListener(v -> verification());

        // Initialisation de Retrofit
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.1.10/soignemoi-web/") // Définir la base de l'URL ici
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        apiService = retrofit.create(ApiService.class);
        Log.d(TAG, "Client Retrofit configuré");
    }

    // Calendrier de la date
    private void showDatePickerDialog(EditText dateField) {
        // Obtenez la date actuelle pour initialiser le DatePickerDialog
        final Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(
                ActiviteAvis.this,
                (view, year1, month1, dayOfMonth) -> {
                    // Format de la date sélectionnée
                    String selectedDate = dayOfMonth + "/" + (month1 + 1) + "/" + year1;
                    dateField.setText(selectedDate);
                },
                year, month, day
        );
        datePickerDialog.show();
    }

    private void pagePrecedente() {
        // Naviguer vers la page précédente
        Intent intent = new Intent(ActiviteAvis.this, ActivitePagePrincipale.class);
        startActivity(intent);
        finish(); // Optionnel : Terminez l'activité actuelle si on ne veut pas qu'elle soit en arrière-plan
    }

    private void verification() {
        // Récupérer les valeurs des EditText
        String texteLibelle = libelle.getText().toString();
        String textePrenomMedecin = prenomMedecin.getText().toString();
        String texteNomMedecin = nomMedecin.getText().toString();
        String texteIdPatient = idPatient.getText().toString();
        String texteDate = date.getText().toString();
        String texteDescriptionAvis = descriptionAvis.getText().toString();
        String messageErreur = "";

        if (texteLibelle.isEmpty()
                || textePrenomMedecin.isEmpty()
                || texteNomMedecin.isEmpty()
                || texteDate.isEmpty()
                || texteDescriptionAvis.isEmpty()
                || texteIdPatient.isEmpty()) {
            messageErreur = "Au moins un des champs n'a pas été saisi";
        }

        if (!messageErreur.isEmpty()) {
            Toast.makeText(this, messageErreur, Toast.LENGTH_SHORT).show();
        } else {
            tableauAvis.put("libelle", texteLibelle);
            tableauAvis.put("prenom", textePrenomMedecin);
            tableauAvis.put("nom", texteNomMedecin);
            tableauAvis.put("idPatient", texteIdPatient);
            tableauAvis.put("date", texteDate);
            tableauAvis.put("description", texteDescriptionAvis);
            Log.d(TAG, "tableauAvis: " + prenomMedecin);
            idMedecin();  // Appeler idMedecin pour récupérer l'ID et envoyer les données
        }
    }

    public void idMedecin() {
        String prenomMedecin = tableauAvis.get("prenom");
        String nomMedecin = tableauAvis.get("nom");

   if (prenomMedecin==null || prenomMedecin.isEmpty() || nomMedecin==null || nomMedecin.isEmpty() ){
            Toast.makeText(this, "Prénom ou/et nom du médecin non fourni", Toast.LENGTH_SHORT).show();
            return;
        }

        Map<String, String> tableauMedecin = new HashMap<>();
        tableauMedecin.put("prenom", prenomMedecin);
        tableauMedecin.put("nom", nomMedecin);

        Call<ReponseMedecin> call = apiService.recupererIdMedecin(tableauMedecin);

        call.enqueue(new Callback<ReponseMedecin>() {
            @Override
            public void onResponse(Call<ReponseMedecin> call, Response<ReponseMedecin> response) {
                if (response.isSuccessful() && response.body() != null) {
                    ReponseMedecin reponseMedecin = response.body();
                    String idMedecin = reponseMedecin.getIdMedecin(); // voir classe ReponseMedecin

                    if (idMedecin!=null) {
                        Log.d(TAG, "tableauAvis avant est: " + tableauAvis.toString());
                        tableauAvis.remove("prenom");
                        tableauAvis.remove("nom");
                        tableauAvis.put("idMedecin", idMedecin);
                        Log.d(TAG, "tableauAvis après est: " + tableauAvis.toString());
                        transfertJSON();
                    }
                    else {
                        Log.d(TAG, "tableauAvis est: " + tableauAvis.toString());
                        Toast.makeText(ActiviteAvis.this, "Rentrer correctement le prénom et le nom du médecin", Toast.LENGTH_LONG).show();
                    }

                } else {
                    Toast.makeText(ActiviteAvis.this, "Une erreur est survenue lors de l'envoi des données. Veuillez réessayer.", Toast.LENGTH_LONG).show();}
              }

            @Override
            public void onFailure(Call<ReponseMedecin> call, Throwable t) {
                Log.e(TAG, "Erreur réseau: " + t.getMessage(), t);
                Toast.makeText(ActiviteAvis.this, "Une erreur réseau est survenue. Veuillez réessayer.", Toast.LENGTH_LONG).show();
            }
        });
    }

    public void transfertJSON() {
        // Préparer l'appel API
        Call<Void> call = apiService.sendAvis(tableauAvis);

        // Exécuter l'appel en arrière-plan
        call.enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                if (response.isSuccessful()) {
                    Log.d(TAG, "Envoi de données réussi.");
                    Toast.makeText(ActiviteAvis.this, "Données envoyées avec succès.", Toast.LENGTH_LONG).show();

                    // Naviguer vers la page suivante après le succès de l'envoi - passage des deux id
                    Intent intent = new Intent(ActiviteAvis.this, ActivitePrescription.class);
                    intent.putExtra("idMedecin", tableauAvis.get("idMedecin"));
                    intent.putExtra("idPatient", tableauAvis.get("idPatient"));
                    startActivity(intent);
                } else {
                    Toast.makeText(ActiviteAvis.this, "Une erreur est survenue lors de l'envoi des données. Veuillez réessayer.", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                Log.e(TAG, "tableauAVIS: " + tableauAvis);
                Log.e(TAG, "Erreur réseau: " + t.getMessage(), t);
                Toast.makeText(ActiviteAvis.this, "Une erreur réseau est survenue. Veuillez réessayer.", Toast.LENGTH_LONG).show();
            }
        });
    }
}
