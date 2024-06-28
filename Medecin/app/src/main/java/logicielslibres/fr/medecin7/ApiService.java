package logicielslibres.fr.medecin7;

import java.util.Map;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.POST;

public interface ApiService {
    @POST("formulaireAvis")
    Call<Void> sendAvis(@Body Map<String, String> avis); //avis:route;

    @POST("formulairePrescription")
    Call<Void> sendPrescription(@Body Map<String, String> prescription); //prescription: route
}
