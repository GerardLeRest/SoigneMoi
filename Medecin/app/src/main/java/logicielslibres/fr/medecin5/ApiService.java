package logicielslibres.fr.medecin5;

import java.util.Map;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.POST;

public interface ApiService {
    @POST("formulaireAvis")
    Call<Void> sendAvis(@Body Map<String, String> avis);

    @POST("formulairePrescription")
    Call<Void> sendPrescription(@Body Map<String, String> prescription);
}
