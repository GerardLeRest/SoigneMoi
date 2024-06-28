package logicielslibres.fr.medecin7;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import androidx.appcompat.app.AppCompatActivity;
import android.widget.Toast;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ActivitePrescription extends AppCompatActivity {

    private static final String TAG = "ActivitePrescription";
    private EditText nomMedicament;
    private EditText posologie;
    private EditText dateDeDebut;
    private EditText dateDeFin;
    private Map<String, String> tableauPrescription;
    private ApiService apiService;

    public ActivitePrescription() {
        tableauPrescription = new HashMap<>();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activite_prescription);

        // Initialisation des vues
        nomMedicament = findViewById(R.id.nomMedicament);
        posologie = findViewById(R.id.posologie);
        dateDeDebut = findViewById(R.id.dateDeDebut);
        dateDeFin = findViewById(R.id.dateDeFin);

        // Ajouter le listener pour le champ de dateDeDebut
        dateDeDebut.setOnClickListener(v -> showDatePickerDialog(dateDeDebut));

        // Ajouter le listener pour le champ de dateDeFin
        dateDeFin.setOnClickListener(v -> showDatePickerDialog(dateDeFin));

        // Configuration du bouton précédent
        Button boutonPrecedent = findViewById(R.id.boutonPrecedent);
        boutonPrecedent.setOnClickListener(v -> pagePrecedente());

        // Configuration du bouton validation
        Button boutonValidation = findViewById(R.id.boutonValidation);
        boutonValidation.setOnClickListener(v -> valider());

        // Initialisation de Retrofit
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.1.10/soignemoi-web/") // Définir la base de l'URL ici
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        apiService = retrofit.create(ApiService.class);
    }

    // Calendrier pour la date
    private void showDatePickerDialog(EditText dateField) {
        // Obtenez la date actuelle pour initialiser le DatePickerDialog
        final Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(
                ActivitePrescription.this,
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
        Intent intent = new Intent(ActivitePrescription.this, ActiviteAvis.class);
        startActivity(intent);
        finish(); // Optionnel : Terminez l'activité actuelle si vous ne voulez pas qu'elle soit en arrière-plan
    }

    private void valider() {
        // Récupérer les valeurs des EditText
        String texteNomMedicament = nomMedicament.getText().toString();
        String textePosologie = posologie.getText().toString();
        String texteDateDeDebut = dateDeDebut.getText().toString();
        String texteDateDeFin = dateDeFin.getText().toString();

        // Remplissage du tableauPrescriptions
        tableauPrescription.put("nomMedicament", texteNomMedicament);
        tableauPrescription.put("posologie", textePosologie);
        tableauPrescription.put("dateDeDebut", texteDateDeDebut);
        tableauPrescription.put("dateDeFin", texteDateDeFin);

        // Traitement des erreurs
        if (!erreurs()) {
            transfertJSON();
        }
    }

    public boolean erreurs() {
        String messageErreur = "";
        String texteNomMedicament = tableauPrescription.get("nomMedicament");
        String textePosologie = tableauPrescription.get("posologie");
        String texteDateDeDebut = tableauPrescription.get("dateDeDebut");
        String texteDateDeFin = tableauPrescription.get("dateDeFin");

        if (texteNomMedicament == null || texteNomMedicament.isEmpty()
                || textePosologie == null || textePosologie.isEmpty()
                || texteDateDeDebut == null || texteDateDeDebut.isEmpty()
                || texteDateDeFin == null || texteDateDeFin.isEmpty()){
            messageErreur = "Au moins un des champs n'a pas été saisi.";
        }
        if (!messageErreur.isEmpty()) {
            int duration = Toast.LENGTH_SHORT;
            Toast toast = Toast.makeText(ActivitePrescription.this, messageErreur, duration);
            toast.show();
            return true;
        } else {
            return false;
        }
    }

    private void transfertJSON() {
        Call<Void> call = apiService.sendPrescription(tableauPrescription);
        call.enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                if (response.isSuccessful()) {
                    Log.d(TAG, "Envoi de données réussi.");
                    // Effacer les champs de la page Prescription
                    nomMedicament.setText("");
                    posologie.setText("");
                    dateDeDebut.setText("");
                    dateDeFin.setText("");
                } else {
                    Log.e(TAG, "Envoi de données échoué. Code de la réponse: " + response.code());
                    Toast.makeText(ActivitePrescription.this, "Une erreur est survenue lors de l'envoi des données. Veuillez réessayer.", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                Log.e(TAG, "Erreur réseau: " + t.getMessage(), t);
                Toast.makeText(ActivitePrescription.this, "Une erreur réseau est survenue. Veuillez réessayer.", Toast.LENGTH_LONG).show();
            }
        });
    }
}
