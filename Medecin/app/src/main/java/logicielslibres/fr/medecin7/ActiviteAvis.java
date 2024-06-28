package logicielslibres.fr.medecin7;

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
    private EditText prenomMedcin;
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
        idPatient = findViewById(R.id.idPatient);
        date = findViewById(R.id.date);
        descriptionAvis = findViewById(R.id.descriptionAvis);

        // Ajouter le listener pour le champ de date
        date.setOnClickListener(v -> showDatePickerDialog(date));

        // Configuration du bouton précédent
        Button boutonPrecedent = findViewById(R.id.boutonPrecedent);
        boutonPrecedent.setOnClickListener(v -> pagePrecedente());

        // Configuration du bouton suivant
        Button boutonSuivant = findViewById(R.id.boutonSuivant);
        boutonSuivant.setOnClickListener(v -> pageSuivante());

        // Initialisation de Retrofit
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.1.10/soignemoi-web/") // Définir la base de l'URL ici
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        apiService = retrofit.create(ApiService.class);

        Log.d(TAG, "Retrofit client configured");
    }

    // Calendrier pour la date
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
        finish(); // Optionnel : Terminez l'activité actuelle si vous ne voulez pas qu'elle soit en arrière-plan
    }

    private void pageSuivante() {
        // Récupérer les valeurs des EditText
        String texteLibelle = libelle.getText().toString();
        String texteIdPatient = idPatient.getText().toString();
        String texteDate = date.getText().toString();
        String texteDescriptionAvis = descriptionAvis.getText().toString();

        // Remplissage du tableauAvis
        tableauAvis.put("libelle", texteLibelle);
        tableauAvis.put("idPatient", texteIdPatient);
        tableauAvis.put("date", texteDate);
        tableauAvis.put("description", texteDescriptionAvis);

        // Traitement des erreurs
        if (!erreurs()) {
            Log.d(TAG, "tableau:" + tableauAvis);
            // Naviguer vers la page suivante
            Intent intent = new Intent(ActiviteAvis.this, ActivitePrescription.class);
            startActivity(intent);
            transfertJSON();
        }
    }

    public boolean erreurs() {
        String messageErreur = "";
        String texteLibelle = tableauAvis.get("libelle");
        String texteIdPatient = tableauAvis.get("idPatient");
        String texteDate = tableauAvis.get("date");
        String texteDescriptionAvis = tableauAvis.get("description");

        if (texteLibelle == null || texteLibelle.isEmpty()
                || texteDate == null || texteDate.isEmpty()
                || texteDescriptionAvis == null || texteDescriptionAvis.isEmpty()
                || texteIdPatient == null || texteIdPatient.isEmpty())  {
            messageErreur = "au moins un des champs n'a pas été saisi";
        }
        // gesstion du nombre idPatient
        else{
            try {
                int IdPatient = Integer.parseInt(texteIdPatient);
            } catch (NumberFormatException e) {
                Toast.makeText(ActiviteAvis.this, "Veuillez entrer un nombre valide", Toast.LENGTH_SHORT).show();
            }
        }

        if (!messageErreur.isEmpty()) {
            int duration = Toast.LENGTH_SHORT;
            Toast toast = Toast.makeText(this, messageErreur, duration);
            toast.show();
            return true;
        } else {
            return false;
        }
    }

    private void transfertJSON() {
        // Préparer l'appel API
        Call<Void> call = apiService.sendAvis(tableauAvis);

        // Exécuter l'appel en arrière-plan
        call.enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                if (response.isSuccessful()) {
                    // Log succès de l'envoi des données
                    Log.d(TAG, "Envoi de données réussi.");

                    // Afficher un message de succès à l'utilisateur
                    Toast.makeText(ActiviteAvis.this, "Données envoyées avec succès.", Toast.LENGTH_LONG).show();
                } else {
                    // Log échec de l'envoi des données
                    Log.e(TAG, "Envoi de données échoué. Code de la réponse: " + response.code());

                    // Afficher un message d'erreur à l'utilisateur
                    Toast.makeText(ActiviteAvis.this, "Une erreur est survenue lors de l'envoi des données. Veuillez réessayer.", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                // Log erreur réseau
                Log.e(TAG, "Erreur réseau: " + t.getMessage(), t);

                // Afficher un message d'erreur réseau à l'utilisateur
                Toast.makeText(ActiviteAvis.this, "Une erreur réseau est survenue. Veuillez réessayer.", Toast.LENGTH_LONG).show();
            }
        });
    }
}

